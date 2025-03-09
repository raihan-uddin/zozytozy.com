<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Picqer\Barcode\BarcodeGeneratorPNG;
use App\Mail\OrderStatusUpdated;
use Illuminate\Support\Facades\Mail;

class AdminOrderController extends Controller
{
    // index
    // Display a listing of the resource.
    public function index(Request $request)
    {
         // Check if a valid status is passed via query parameter
        $status = $request->query('status');

        $orders = Order::with('user') // Assuming there’s a relationship defined with User
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(16);

        //dynamic page title based on status with count
        $pageTitle = $status ? 'Orders - '.ucfirst($status).' ('.$orders->total().')' : 'All Orders ('.$orders->total().')';

        // Return the view with orders
        return view('admin.orders.index', compact('orders', 'pageTitle'));
    }

    public function recentOrders()
    {
        // Fetch the 5 most recent orders
        $recentOrders = Order::orderBy('created_at', 'desc')->take(5)->get();

        // Return the orders as a JSON response
        return response()->json(['orders' => $recentOrders]);
    }

    public function show($id)
    {
        // Find the order by ID
        $order = Order::find($id);

        $generator = new BarcodeGeneratorPNG;
        $barcode = base64_encode($generator->getBarcode($order->id, $generator::TYPE_CODE_128));

        // Check if the order exists
        if (! $order) {
            // Redirect back with an error message if not found
            return redirect()->route('orders.index')->with('error', 'Order not found.');
        }

        $pageTitle = 'Order details: '.$order->id;

        // Pass the order data to the view
        return view('admin.orders.show', compact('order', 'pageTitle', 'barcode'));
    }

    public function updateStatus(Request $request)
    {
        // Validate the request
        $request->validate([
            'status' => 'required',
            'order_id' => 'required|exists:orders,id',
        ]);
        info ($request->all());

        // Find the order by ID
        $order = Order::find($request->order_id);

        // Check if the order exists
        if (! $order) {
            return url()->previous() 
            ? redirect()->back()->withInput()->with('error', 'Order not found.')
            : redirect()->route('orders.index')->with('error', 'Order not found.');
        }
        // db transaction
        DB::beginTransaction();
        try {
            // Update the order status
            $order->status = $request->status;
            $order->save();
            info($order);

            // save the order status history
            $status = $order->statuses()->create([
                'status' => $request->status,
                'note' => $request->note,
                'created_by' => auth()->id(),
            ]);
            DB::commit();

            // Send an email notification to the user
            Mail::to($order->user->email)->send(new OrderStatusUpdated($order));
        } catch (\Exception $e) {
            DB::rollBack();
            info($e->getMessage());
            return url()->previous() 
            ? redirect()->back()->withInput()->with('error', 'Failed to update order status.')
            : redirect()->route('orders.index')->with('error', 'Failed to update order status.');
        }

        // Redirect back with a success message
        return url()->previous()
        ? redirect()->back()->with('success', 'Order status updated successfully.')
        : redirect()->route('orders.index')->with('success', 'Order status updated successfully.');
        
    }
}
