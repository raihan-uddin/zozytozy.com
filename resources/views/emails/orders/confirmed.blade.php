@component('mail::message')
{{-- Header Section --}}
<div style="background-color: #f8fafc; padding: 30px 0;">
    <h1 style="text-align: center; color: #4A90E2; font-size: 30px; font-weight: bold;">
        Order Confirmed & Paid
    </h1>
    <p style="text-align: center; font-size: 18px; color: #333;">
        Your order has been successfully confirmed and paid. Thank you for completing your purchase!
    </p>
</div>

{{-- Order Details Section --}}
<div style="background-color: #ffffff; padding: 20px 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); margin: 20px auto; max-width: 600px;">
    <p style="font-size: 18px; font-weight: bold; color: #333;">Order ID: <span style="color: #4A90E2;">#{{ $order->id }}</span></p>
    {{-- order number --}}
    <p style="font-size: 16px; color: #555;">Order Number: <strong>{{ $order->order_number }}</strong></p>
    {{-- order date --}}
    <p style="font-size: 16px; color: #555;">Order Date: <strong>{{ $order->created_at->format('F j, Y') }}</strong></p>
</div>

{{-- Order Summary Section --}}
<div style="background-color: #ffffff; padding: 20px 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); margin-top: 20px; max-width: 600px;">
    <h2 style="font-size: 22px; color: #4A90E2;">Order Summary</h2>
    @foreach($order->items as $item)
    <p style="font-size: 16px; color: #555;">
        - <strong>{{ $item->product_name }}</strong> @if($item->size) <small>-Size: {{ $item->size }}</small>@endif  @if($item->Color)<small>-Color: {{ $item->Color }}</small> @endif x {{ $item->quantity }} - ${{ number_format($item->price, 2) }}
    </p>
    @endforeach
</div>

{{-- Shipping & Tax Details --}}
<div style="background-color: #ffffff; padding: 20px 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); margin-top: 20px; max-width: 600px;">
    <h2 style="font-size: 22px; color: #4A90E2;">Shipping & Tax</h2>
    <p style="font-size: 16px; color: #555;">
        <strong>Shipping:</strong> ${{ number_format($order->shipping_cost, 2) }}<br>
        <strong>Tax:</strong> ${{ number_format($order->tax_amount, 2) }}
    </p>
</div>

{{-- Total Amount --}}
<div style="background-color: #ffffff; padding: 20px 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); margin-top: 20px; max-width: 600px;">
    <h2 style="font-size: 22px; color: #4A90E2;">Total: ${{ number_format($order->total, 2) }}</h2>
</div>

{{-- View Order Details --}}
@component('mail::button', ['url' => route('user.order.show', $order->order_number)])
View Order Details
@endcomponent

{{-- Footer Section --}}
<div style="text-align: center; padding: 20px 0; background-color: #f8fafc;">
    @if($order->shipping_method == 'store_pickup')
        <p style="font-size: 16px; color: #333;">Your order is ready for pickup at our store. Please bring your order number and a valid ID.</p>
    @else
        <p style="font-size: 16px; color: #333;">Thank you for your order! We are processing it and will send you an update once it's shipped.</p>
    @endif
    <p style="font-size: 16px; color: #333;">We appreciate your business and look forward to serving you again soon.</p>
    <p style="font-size: 14px; color: #777;">
        If you have any questions or need assistance, feel free to contact our support team at <a href="mailto:support@zozytozy.com.bd" style="color: #4A90E2;">support@preciousbotanic.com</a>
    </p>
</div>

@endcomponent
