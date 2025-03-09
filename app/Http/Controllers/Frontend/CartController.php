<?php

namespace App\Http\Controllers\Frontend;

use App\Events\OrderConfirmed;
use App\Events\OrderSubmitted;
use App\Http\Controllers\Controller;
use App\Http\Requests\PlaceOrderRequest;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $product = Product::find($request->product_id);
        if (!$product) {
            return response()->json([
                'message' => 'Product not found. Please try again',
            ], 404);
        }

        // check if product has variations
        if ($product->variations->count() > 0) {
            $request->validate([
                'variants' => 'required|array',
            ]);
        }

        // retrieve the product price from database
        $price = $product->price;

        return response()->json([
            'message' => 'Product added to cart successfully',
        ]);
    }

    public function cart()
    {
        $pageTitle = 'Cart';

        return view('frontend.pages.cart', compact('pageTitle'));
    }

    public function checkout(Request $request)
    {

        // check if user is logged in
        if (!$request->user()) {
            return redirect()->route('login');
        }
        $countries = Country::active()->select('id', 'name', 'iso_3166_2', 'iso_3166_3', 'currency_symbol', 'country_code')->get();
        $states = State::active()->orderByState()->select('id', 'zip_code', 'state', 'zip_code_pattern', 'delivery_fee', 'tax_rate')->get();
        $coupons = Coupon::valid()->get();

        $pageTitle = 'Checkout';

        return view('frontend.pages.checkout', compact('pageTitle', 'countries', 'states', 'coupons'));
    }

    public function submitOrder(PlaceOrderRequest $request)
    {
        $shipping_state_id = $request->shipping_state_id;
        $shipping_country_id = $request->shipping_country_id;

        $shippingCountry = Country::find($shipping_country_id);
        $shippingState = State::find($shipping_state_id);

        $order = new Order;
        $order->order_number = (string)Str::uuid(); // Generate UUID
        $order->user_id = $request->user()->id;
        $order->guest_email = $request->user()->email ?? null;
        $order->guest_name = $request->user()->name ?? null;
        $order->payment_method = 'stripe'; // Default payment method

        // shipping info
        $order->shipping_method = $request->shipping_method;
        $order->shipping_name = $request->shipping_fullname;
        $order->shipping_address = $request->shipping_address;
        $order->shipping_address2 = $request->shipping_address2;
        $order->shipping_city = $request->shipping_city;
        $order->shipping_state = $shippingState->state;
        $order->shipping_zip = $request->zip_code;
        $order->shipping_country = $shippingCountry->iso_3166_2;
        $order->shipping_state_id = $shippingState->id;
        $order->shipping_country_id = $shippingCountry->id;
        $order->guest_phone = $request->phone;

        // billing info
        $order->billing_name = $request->billing_fullname;
        $order->billing_address = $request->billing_address;
        $order->billing_address2 = $request->billing_address2;
        $order->billing_city = $request->billing_city;
        $order->billing_state = $request->billing_state_id;
        $order->billing_zip = $request->billing_zip;
        $order->billing_country = $shippingCountry->iso_3166_2;

        $order->tax_rate = $shippingState->tax_rate;
        $order->tax_amount = $request->tax_amount;
        $order->shipping_cost = $request->delivery_charge;
        $order->coupon_code = $request->coupon_code;
        $order->discount_amount = $request->discount_amount;
        $order->total_items = $request->total_items;
        $order->subtotal = $request->subtotal;
        $order->total = $request->total;
        $order->notes = $request->notes;
        $order->ip_address = $request->ip();
        $order->user_agent = $request->header('User-Agent');

        // begin transaction
        DB::beginTransaction();
        try {
            // save the order
            $order->save();

            // save order items
            $itemTotalPrice = 0;
            $variantData = null;
            foreach ($request->cart as $item) {
                // find the product by id
                $product = Product::find($item['id']);
                if (!$product) {
                    DB::rollBack();
                    throw new \Exception('Product not found. Please try again');
                }
                $price = $product->price;
                $sku = $product->sku;
                if ($product->variants->count() > 0) {
                    $size = isset($item['variant']['size']) ? $item['variant']['size'] : null;
                    $color = isset($item['variant']['color']) ? $item['variant']['color'] : null;
                    if ($size && $color) {
                        $variantData = $product->variants()->where('size', $size)
                            ->where('color', $color)
                            ->first();
                    } elseif ($size) {
                        $variantData = $product->variants()->where('size', $size)
                            ->first();
                    } elseif ($color) {
                        $variantData = $product->variants()->where('color', $color)
                            ->first();
                    }

                    if (!$variantData) {
                        DB::rollBack();
                        throw new \Exception('Invalid variant selected for the product ' . $product->name);
                    }
                    $price = $variantData->price;
                    $sku = $variantData->sku;
                }
                $dataItems = $order->items()->create([
                    'product_id' => $item['id'],
                    'product_name' => $product->name,
                    'sku' => $sku,
                    'quantity' => $item['qty'],
                    'price' => round($price, 2),
                    'subtotal' => round($price * $item['qty'], 2),
                    'variant_id' => $variantData->id ?? null,
                    'size' => $size ?? null,
                    'color' => isset($color) ? $color : null,
                    'variant_data' => $variantData ? json_encode($variantData) : null,
                ]);
                if (!$dataItems) {
                    throw new \Exception('Failed to save order items');
                }
                $itemTotalPrice += round($price * $item['qty'], 2);
            }

            $couponDiscountInfo = Coupon::applyCoupon($request->coupon_code, $itemTotalPrice, $request->user()->id);
            if($couponDiscountInfo['valid']) {
                $order->coupon_code = $request->coupon_code;
                $order->discount_amount = $couponDiscountInfo['discount'];
                $order->total = $couponDiscountInfo['total'];
            }

            $itemTotalWithDiscount = $itemTotalPrice - $order->discount_amount;


            // update the order total
            $order->subtotal = $itemTotalPrice;
            // if itemTotalPrice is >= 200 then shipping is free
            if ($itemTotalPrice >= 200) {
                $order->shipping_cost = 0;
            }
            $order->tax_amount = round(($itemTotalWithDiscount * $shippingState->tax_rate) / 100, 2);
            // total
            $order->total = round($itemTotalWithDiscount + $order->tax_amount + $order->shipping_cost, 2);
            // save the order
            if (!$order->save()) {
                throw new \Exception('Failed to update order total');
            }
            // commit the transaction
            DB::commit();

            // Eager load the order items before dispatching the event
            // $order->load('items');
            event(new OrderSubmitted($order));

            $session = $this->createStripeSession($order);

            return response()->json([
                'message' => 'Order placed successfully',
                'order_id' => $order->id,
                'success' => true,
                'url' => $session->url,
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            // log the error
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'Failed to place order. Please try again . ' . $e->getMessage(),
                'success' => false,
                'url' => null,
                'order_id' => null,
            ], 500);
        }
    }

    public function orderSuccess(Request $request)
    {
        // Set the Stripe API key
        Stripe::setApiKey(config('stripe.secret_key'));

        $sessionId = $request->query('session_id');
        DB::beginTransaction();
        try {
            // Retrieve the session
            $session = Session::retrieve($sessionId);
            $metadata = $session->metadata;
            $order = Order::find($metadata['order_id']);
            if (!$order) {
                return redirect()->route('home');
            }

            // Update the order status
            $order->payment_status = 'paid';
            $order->status = 'confirmed';
            $order->payment_amount = round(($session->amount_total / 100), 2);  // Convert amount from cents to dollars
            $order->payment_response = json_encode($session);
            $order->payment_completed_at = now();
            $order->save();

            // Commit the transaction
            DB::commit();

            event(new OrderConfirmed($order));

        } catch (\Exception $e) {
            DB::rollBack();

            // log failed transaction
            Log::error('Failed to complete order', [
                'session_id' => $sessionId,
                'error' => $e->getMessage(),
            ]);

            // Handle error if session retrieval fails
            Log::error('Failed to retrieve Stripe session', [
                'session_id' => $sessionId,
                'error' => $e->getMessage(),
            ]);

            return redirect()->route('order.failed')->with('error', 'Payment session retrieval failed.');
        }

        // show success page
        return view('frontend.user.order.order-success', compact('order'));
    }

    public function orderCancel(Request $request)
    {
        // Get the session_id from the query parameters (if needed)
        $sessionId = $request->query('session_id');

        // Optionally, you might want to log the cancellation attempt
        Log::info('Order cancellation requested', ['session_id' => $sessionId]);

        // Here, you might want to retrieve the order from the database
        // This assumes that you have some way to identify the order; adjust accordingly
        // You can store the order ID in the session, in the query string, etc.
        $orderId = $request->query('order_id'); // Example of getting order_id from query parameters
        $order = Order::find($orderId);

        if ($order) {
            // Update the order status to cancelled
            $order->payment_status = 'cancelled'; // or whatever status is appropriate
            $order->payment_completed_at = null; // Clear completed time if necessary
            $order->save();

            // Optionally notify the user of the cancellation
            // This could be an email, a notification, etc.
            // Notification::send($user, new OrderCancelled($order)); // Example notification
        }

        return view('frontend.user.order.order-canceled');
    }

    // generate session for stripe
    public function createStripeSession($order)
    {
        // Set up Stripe api key
        Stripe::setApiKey(config('stripe.secret_key'));
        $lineItems = $this->generateTotalAmountForStripe($order);

        $session = Session::create([
            // Payment Method Types (card is for any type of credit/debit card)
            'payment_method_types' => [
                'card',           // Credit/Debit Cards (Visa, MasterCard, Amex)
                // 'paypal',         // PayPal (if needed)
                'amazon_pay',     // Amazon Pay (if needed)
                // 'customer_balance', // Store Credit (if needed)
            ],

            // Line Items (products, delivery fee, taxes, etc.)
            'line_items' => $lineItems,

            // Payment Mode (single payment)
            'mode' => 'payment',

            // URLs for success and cancel
            'success_url' => route('order.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('order.cancel'),

            // Metadata to store order-related info
            'metadata' => [
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'customer_name' => $order->shipping_name,
            ],

            // Optional: Send email receipt to customer
            'receipt_email' => $order->customer_email,

            // Optional: Customize appearance of the checkout page
            'payment_intent_data' => [
                'metadata' => [
                    'order_id' => $order->id,
                    'order_number' => $order->order_number,
                    'customer_name' => $order->shipping_name,
                ],
                'description' => 'Payment for Order #' . $order->order_number,
            ],

            'customer_email' => $order->guest_email,
            'client_reference_id' => $order->id,
        ]);

        return $session;
    }

    public function generateLineItemsForStripe($order)
    {
        $lineItems = $order->items->map(function ($item) {
            // Check if the item has the necessary properties before creating line item data
            if (empty($item->product_name) || empty($item->price) || empty($item->quantity)) {
                // Log error and return null to filter out invalid items
                Log::error('Invalid item found in order', [
                    'item_id' => $item->id,
                    'product_name' => $item->product_name,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                ]);

                return null; // Skip this item
            }

            return [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $item->product_name,
                        'metadata' => [
                            'product_id' => $item->id,
                            'sku' => $item->sku,
                            'variant_id' => $item->variant_id,
                            'size' => $item->size,
                            'color' => $item->color,
                        ],
                    ],
                    'unit_amount' => (float)$item->price * 100, // Price in cents
                ],
                'quantity' => (int)$item->quantity, // Quantity
            ];
        })->filter()->toArray(); // Use filter to remove any null entries

        // Add Delivery Fee as a line item (if applicable)
        if ($order->shipping_cost > 0) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Delivery Fee',
                    ],
                    'unit_amount' => (float)$order->shipping_cost * 100, // Delivery fee in cents
                ],
                'quantity' => 1,
            ];
        }

        // Add Tax Fee as a line item (if applicable)
        if ($order->tax_amount > 0) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        // mention tax_rate
                        'name' => 'Tax (' . $order->tax_rate . '%)',
                    ],
                    'unit_amount' => (float)$order->tax_amount * 100, // Tax fee in cents
                ],
                'quantity' => 1,
            ];
        }

        return $lineItems;
    }

    public function generateTotalAmountForStripe($order)
    {
        // Create a single line item for the total order value
        $lineItems = [
            [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Order Total',
                    ],
                    'unit_amount' => (float)$order->total * 100, // Total amount in cents
                ],
                'quantity' => 1,
            ],
        ];

        return $lineItems;
    }

    public function orderStatus($orderObj, $status, $note): void
    {
        $orderObj->status = $status;
        $orderObj->notes = $note;
        $orderObj->created_by = auth()->user()->id;
        $orderObj->save();
    }


    public function applyCoupon(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string|exists:coupons,code',
            'cart' => 'required|array',
            'subtotal' => 'required|numeric|min:0',
        ]);

        $coupon = Coupon::code($request->coupon_code)->valid()->first();
        if (!$coupon) {
            return response()->json([
                'message' => 'Coupon not found. Please try again',
                'success' => false,
                'coupon_code' => '',
            ], 404);
        }

        // check if the coupon is valid
        // if (!$coupon->isValidFor($request->user()->id)) {
        //     return response()->json([
        //         'message' => 'Coupon is not valid for this order',
        //     ], 400);
        // }

        // calculate cart subtotal
        $subtotal = 0;
        foreach ($request->cart as $item) {
            $subtotal += $item['price'] * $item['qty'];
        }

        $discountInfo = Coupon::applyCoupon($request->coupon_code, $subtotal, $request->user()->id);

        // calculate discount amount
        $discountAmount = $discountInfo['discount'];

        // check if the discount amount is greater than the cart subtotal
        if ($discountAmount > $subtotal) {
            return response()->json([
                'message' => 'Coupon discount amount is greater than the cart subtotal',
                'success' => false,
                'coupon_code' => '',
            ], 400);
        }
        

        return response()->json([
            'message' => 'Coupon applied successfully',
            'discount_amount' => $discountAmount,
            'success' => true,
            'coupon_code' => $coupon->code,
        ]);
    }
}
