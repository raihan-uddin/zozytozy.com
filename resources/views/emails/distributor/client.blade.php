@component('mail::message')
{{-- Header Section --}}
<div style="background-color: #f8fafc; padding: 30px 0;">
    <h1 style="text-align: center; color: #4A90E2; font-size: 30px; font-weight: bold;">
        Thank You for Reaching Out!
    </h1>
    <p style="text-align: center; font-size: 18px; color: #333;">
        We’ve received your information and will contact you at your preferred time.
    </p>
</div>

{{-- Customer Details Section --}}
<div style="background-color: #ffffff; padding: 20px 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); margin: 20px auto; max-width: 600px;">
    <h2 style="font-size: 22px; color: #4A90E2;">Your Information</h2>
    <p style="font-size: 16px; color: #555;">
        <strong>Name:</strong> {{ $data['first_name'] }}<br>
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

{{-- Confirmation Section --}}
<div style="background-color: #ffffff; padding: 20px 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); margin-top: 20px; max-width: 600px;">
    <p style="font-size: 16px; color: #555;">
        Thank you for providing your details. We will reach out to you soon based on your preferred time. If you need immediate assistance, feel free to contact us directly at <strong>312-533-6604</strong> between <strong>9 AM to 7 PM</strong>.
    </p>
</div>

{{-- Footer Section --}}
<div style="text-align: center; padding: 20px 0; background-color: #f8fafc;">
    <p style="font-size: 16px; color: #333;">We appreciate your interest and look forward to assisting you!</p>
    <p style="font-size: 14px; color: #777;">
        If you have any questions, don’t hesitate to email us at
        <a href="mailto:support@binbox.com.bd" style="color: #4A90E2;">support@binbox.com.bd</a>.
    </p>
</div>

@endcomponent
