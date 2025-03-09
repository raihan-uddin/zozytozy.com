@extends('frontend.layouts.default')
@section('title', 'Dashboard')

@section('content')
<!-- Breadcrumb -->
<section class="section-breadcrumb mb-[50px] max-[1199px]:mb-[35px] border-b-[1px] border-solid border-[#eee] bg-[#f8f8fb]">
    <div class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
        <div class="flex flex-wrap w-full">
            <div class="w-full px-[12px]">
                <div class="flex flex-wrap w-full bb-breadcrumb-inner m-[0] py-[20px] items-center">
                    <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                        <h2 class="bb-breadcrumb-title font-quicksand tracking-[0.03rem] leading-[1.2] text-[16px] font-bold text-[#3d4750] max-[767px]:text-center max-[767px]:mb-[10px]">Dashboard</h2>
                    </div>
                    <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                        <ul class="bb-breadcrumb-list mx-[-5px] flex justify-end max-[767px]:justify-center">
                            <li class="bb-breadcrumb-item text-[14px] font-normal px-[5px]"><a href="{{ route('home') }}" class="font-Poppins text-[14px] leading-[28px] tracking-[0.03rem] font-semibold text-[#686e7d]">Home</a></li>
                            <li class="text-[14px] font-normal px-[5px]"><i class="ri-arrow-right-double-fill text-[14px] font-semibold leading-[28px]"></i></li>
                            <li class="bb-breadcrumb-item font-Poppins text-[#686e7d] text-[14px] leading-[28px] font-normal tracking-[0.03rem] px-[5px] active">Orders</li>
                            <li class="text-[14px] font-normal px-[5px]"><i class="ri-arrow-right-double-fill text-[14px] font-semibold leading-[28px]"></i></li>
                            <li class="bb-breadcrumb-item font-Poppins text-[#686e7d] text-[14px] leading-[28px] font-normal tracking-[0.03rem] px-[5px] active">Order Details</li>
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
            <h1 class="text-2xl font-bold mb-4">Order Details</h1>

            <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                <h2 class="font-semibold text-xl">Order #{{ $order->order_number }}</h2>
                <p class="text-gray-600">Placed on: {{ $order->created_at->format('F j, Y, g:i a') }}</p>
                <p class="text-gray-600">Order Status: <span class="font-semibold text-green-500">{{ ucfirst($order->status) }}</span></p>
                <p class="text-gray-600">Payment Status: <span class="font-semibold {{ $order->payment_status === 'paid' ? 'text-green-500' : 'text-red-500' }}">{{ ucfirst($order->payment_status) }}</span></p>
                <p class="text-gray-600">Total: <span class="font-bold text-lg">${{ number_format($order->total, 2) }}</span></p>
            </div>            

            <h3 class="font-semibold text-lg mb-2">Order Items</h3>
            <div class="bg-white shadow-md rounded-lg p-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($order->items as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->product->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->quantity }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">${{ number_format($item->price, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                <a href="{{ route('user.order.index') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white rounded-md px-4 py-2">Back to Orders</a>
            </div>
        </div>
    </div>
</div>
@endsection
