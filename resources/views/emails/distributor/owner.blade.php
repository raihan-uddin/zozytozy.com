@component('mail::message')
{{-- Header Section --}}
<div style="background-color: #f8fafc; padding: 30px 0;">
    <h1 style="text-align: center; color: #4A90E2; font-size: 30px; font-weight: bold;">
        New Wholesale Inquiry
    </h1>
    <p style="text-align: center; font-size: 18px; color: #333;">
        A potential wholesale customer has submitted their information. Please review the details below:
    </p>
</div>

{{-- Customer Details Section --}}
<div style="background-color: #ffffff; padding: 20px 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); margin: 20px auto; max-width: 600px;">
    <h2 style="font-size: 22px; color: #4A90E2;">Customer Information</h2>
    <p style="font-size: 16px; color: #555;">
        <strong>Business Name:</strong> {{ $data['company_name'] ?? 'N/A' }}<br>
        <strong></strong>Business Address:</strong> {{ $data['company_address'] ?? 'N/A' }}<br>
        <strong>Contact Person:</strong> {{ $data['first_name'] }}<br>
        <strong>Email:</strong> {{ $data['email'] }}<br>
        <strong>Phone:</strong> {{ $data['phone'] }}<br>
        <strong>Preferred Time to Contact:</strong> 
        @if(is_array($data['best_time']))
            {{ implode(', ', $data['best_time']) }}
        @else
            {{ $data['best_time'] }}
        @endif
    </p>
</div>

{{-- Action Section --}}
<div style="background-color: #ffffff; padding: 20px 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); margin-top: 20px; max-width: 600px;">
    <p style="font-size: 16px; color: #555;">
        Please reach out to the customer to discuss their wholesale requirements. For immediate action, contact them directly using the provided details.
    </p>
</div>

{{-- Footer Section --}}
<div style="text-align: center; padding: 20px 0; background-color: #f8fafc;">
    <p style="font-size: 16px; color: #333;">Thank you for handling this inquiry promptly!</p>
</div>

@endcomponent
