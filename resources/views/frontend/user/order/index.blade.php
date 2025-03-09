@extends('frontend.layouts.default')
@section('title', 'My Orders')

@section('content')
<!-- Breadcrumb -->
<section class="section-breadcrumb mb-[50px] max-[1199px]:mb-[35px] border-b-[1px] border-solid border-[#eee] bg-[#f8f8fb]">
    <div class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
        <div class="flex flex-wrap w-full">
            <div class="w-full px-[12px]">
                <div class="flex flex-wrap w-full bb-breadcrumb-inner m-[0] py-[20px] items-center">
                    <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                        <h2 class="bb-breadcrumb-title font-quicksand tracking-[0.03rem] leading-[1.2] text-[16px] font-bold text-[#3d4750] max-[767px]:text-center max-[767px]:mb-[10px]">My Orders</h2>
                    </div>
                    <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                        <ul class="bb-breadcrumb-list mx-[-5px] flex justify-end max-[767px]:justify-center">
                            <li class="bb-breadcrumb-item text-[14px] font-normal px-[5px]"><a href="{{ route('home') }}" class="font-Poppins text-[14px] leading-[28px] tracking-[0.03rem] font-semibold text-[#686e7d]">Home</a></li>
                            <li class="text-[14px] font-normal px-[5px]"><i class="ri-arrow-right-double-fill text-[14px] font-semibold leading-[28px]"></i></li>
                            <li class="bb-breadcrumb-item font-Poppins text-[#686e7d] text-[14px] leading-[28px] font-normal tracking-[0.03rem] px-[5px] active">Orders</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="max-w-[1320px] mx-auto px-4">
    <div class="flex flex-wrap gap-4">
        @include('frontend.user.partials.user-nav')

        <div class="flex-1 bg-white border border-[#ddd] rounded-lg p-4">
            <h3 class="font-semibold text-lg mb-4">Recent Orders</h3>
            @if ($orders->count())
                <div class="grid grid-cols-1 gap-4">
                    @foreach ($orders as $order)
                        <div class="border border-[#ddd] rounded-lg p-4 hover:shadow-md transition-shadow duration-200">
                            <h5 class="font-semibold">Order #{{ $order->order_number }}</h5>
                            <p class="text-gray-600">Total: ${{ number_format($order->total, 2) }}</p>
                            <p class="text-gray-600">Status: <span class="font-semibold text-green-600">{{ ucfirst($order->status) }}</span></p>
                            
                            <!-- Payment Status -->
                            <p class="text-gray-600">Payment Status: 
                                <span class="font-semibold {{ $order->payment_status == 'paid' ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $order->payment_status == 'paid' ? 'Paid' : 'Not Paid' }}
                                </span>
                            </p>

                            <!-- Conditionally display the Pay Now button -->
                            @if ($order->payment_status == 'pending')
                                <a href="#" class="mt-2 inline-block text-white bg-green-500 hover:bg-green-600 rounded px-3 py-1">Pay Now</a>
                            @else
                                <a href="{{ route('user.order.show', $order->order_number) }}" class="mt-2 inline-block text-white bg-blue-500 hover:bg-blue-600 rounded px-3 py-1">View Order</a>
                            @endif
                        </div>
                    @endforeach

                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $orders->links() }} <!-- Render pagination links -->
                </div>
            @else
                <p class="text-gray-600">No orders found.</p>
            @endif
        </div>
    </div>
</div>
@endsection
