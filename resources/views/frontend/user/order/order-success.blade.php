@extends('frontend.layouts.default')
@section('title', 'Order Success')

@section('content')

    <!-- Breadcrumb -->
    <section class="section-breadcrumb mb-[50px] max-[1199px]:mb-[35px] border-b-[1px] border-solid border-[#eee] bg-[#f8f8fb]">
        <div class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
            <div class="flex flex-wrap w-full">
                <div class="w-full px-[12px]">
                    <div class="flex flex-wrap w-full bb-breadcrumb-inner m-[0] py-[20px] items-center">
                        <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                            <h2 class="bb-breadcrumb-title font-quicksand tracking-[0.03rem] leading-[1.2] text-[16px] font-bold text-[#3d4750] max-[767px]:text-center max-[767px]:mb-[10px]">Order Success</h2>
                        </div>
                        <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                            <ul class="bb-breadcrumb-list mx-[-5px] flex justify-end max-[767px]:justify-center">
                                <li class="bb-breadcrumb-item text-[14px] font-normal px-[5px]"><a href="{{ route('home') }}" class="font-Poppins text-[14px] leading-[28px] tracking-[0.03rem] font-semibold text-[#686e7d]">Home</a></li>
                                <li class="text-[14px] font-normal px-[5px]"><i class="ri-arrow-right-double-fill text-[14px] font-semibold leading-[28px]"></i></li>
                                <li class="bb-breadcrumb-item font-Poppins text-[#686e7d] text-[14px] leading-[28px] font-normal tracking-[0.03rem] px-[5px] active">Order Success</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Order Success Details -->
    <section class="bg-gradient-to-r py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 rounded-lg shadow">
        <div class="flex flex-col justify-center items-center"> <!-- Changed text color for better readability -->
            <h3 class="text-4xl font-extrabold mb-4 text-center text-[#6c7fd8]">🎉 Thank You for Your Order!</h3> <!-- Increased font size and kept white -->
            <p class="mb-6 text-lg font-medium leading-7 text-center text-[#6c7fd8]"> <!-- Lightened the text color for contrast -->
                Your order has been successfully processed. We appreciate your business!
            </p>
    
            <div class="bg-white rounded-lg p-6 mb-6 w-full max-w-2xl shadow-sm">
                <h4 class="text-xl font-semibold mb-4">Order Summary</h4>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="font-medium">Order ID:</span>
                        <span>{{ $order->id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Order Number:</span>
                        <span>{{ $order->order_number }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium ">Order Date:</span>
                        <span>{{ $order->created_at->format('F j, Y, g:i a') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Order Status:</span>
                        <span>{{ ucfirst($order->status) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Payment Status:</span>
                        <span>{{ ucfirst($order->payment_status) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Amount Paid:</span>
                        <span>${{ number_format($order->payment_amount, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Payment Completed At:</span>
                        <span>{{ $order->payment_completed_at->format('F j, Y, g:i a') }}</span>
                    </div>
                </div>
            </div>
    
            <p class="text-lg text-[#6c7fd8] font-light text-center">
                We are processing your order immediately! A confirmation email has been sent to your email address. 📧
            </p>
            
            <!-- Optional: Include a celebratory graphic -->
            {{-- <img src="{{ asset('path/to/your/celebration-graphic.png') }}" alt="Celebration" class="mt-4 w-1/2 md:w-1/3 rounded-lg shadow-lg"> --}}
        </div>
    </section>
    @include('frontend.partials.services')
@endsection


@push('scripts')
<script>
    window.addEventListener('load', function() {
        localStorage.removeItem('cart');
        localStorage.removeItem('orderNote');
    });
</script>
@endpush
