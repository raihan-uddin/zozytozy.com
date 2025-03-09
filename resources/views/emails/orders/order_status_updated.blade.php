@component('mail::message')
{{-- Header Section --}}
<div style="background-color: #4A90E2; padding: 40px 0; text-align: center; border-radius: 8px 8px 0 0;">
    <h1 style="color: #ffffff; font-size: 34px; font-weight: bold; margin: 0;">
        Order Status Updated
    </h1>
    <p style="color: #f1f1f1; font-size: 18px; margin-top: 10px;">
        We're excited to let you know that the status of your order has changed. Here are the details:
    </p>
</div>

{{-- Order Details Section --}}
<div style="background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin: 20px auto; max-width: 650px;">
    <p style="font-size: 18px; color: #333333; font-weight: bold; margin-bottom: 10px;">
        <span style="color: #4A90E2;">Order Number:</span> <strong>{{ $order->order_number }}</strong>
    </p>
    <p style="font-size: 16px; color: #555555; margin-bottom: 8px;">
        <span style="color: #4A90E2;">Order ID:</span> #{{ $order->id }}
    </p>
    <p style="font-size: 16px; color: #555555; margin-bottom: 20px;">
        <span style="color: #4A90E2;">Order Date:</span> {{ $order->created_at->format('F j, Y') }}
    </p>

    {{-- Status Update --}}
    <div style="padding: 20px; background-color: #f8fafc; border-left: 5px solid #4A90E2; border-radius: 4px;">
        <h3 style="color: #4A90E2; font-size: 20px; margin-bottom: 10px;">
            Your Order Status: <strong>{{ ucfirst($order->status) }}</strong>
        </h3>
        <p style="font-size: 16px; color: #555555;">
            @if($order->status_note)
                <strong>Note:</strong> {{ $order->status_note }}
            @else
                Thank you for your patience as we process your order. You’ll receive further updates soon!
            @endif
        </p>
    </div>
</div>

{{-- View Order Details --}}
@component('mail::button', ['url' => route('user.order.show', $order->order_number)])
View Your Order Details
@endcomponent

{{-- Footer Section --}}
<div style="text-align: center; padding: 30px 0; background-color: #f1f1f1; font-size: 14px; color: #777777; border-radius: 0 0 8px 8px;">
    <p style="margin: 0; font-size: 16px; color: #555555;">
        @if($order->shipping_method == 'store_pickup' && $order->status == 'confirmed' || $order->status == 'processing')
            Your order is ready for pickup at our store. Please bring your order number and a valid ID.
        @endif ($order->status == 'pending')
            Your order is being processed. You'll receive an update once it's ready for pickup.
        @endif ($order->status == 'confirmed')
            Your order is confirmed and is being processed. You'll receive an update once it's ready for pickup.
        @endif ($order->status == 'shipped')
            Your order has been shipped.
        @endif ($order->status == 'delivered')
            Your order has been delivered. If you have any questions, please contact us.
        @endif ($order->status == 'returned')
            Your order has been returned. If you have any questions, please contact us.
        @endif ($order->status == 'refunded')
            Your order has been refunded. If you have any questions, please contact us.
        @endif ($order->status == 'canceled')
            Your order has been canceled. If you have any questions, please contact us.
        @endif ($order->status == 'on_hold')
            Your order is on hold. If you have any questions, please contact us.
        @endif

    </p>
    <p style="margin-top: 10px; font-size: 14px;">
        If you have any questions or need further assistance, please feel free to reach out to us at <a href="mailto:support@binbox.com.bd" style="color: #4A90E2;">support@preciousbotanic.com</a>.
    </p>
    <p style="margin-top: 10px; font-size: 14px;">
        &copy; {{ date('Y') }} BinBox. All Rights Reserved.
    </p>
</div>

@endcomponent
