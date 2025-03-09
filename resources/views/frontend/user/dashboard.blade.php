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
                                <li class="bb-breadcrumb-item font-Poppins text-[#686e7d] text-[14px] leading-[28px] font-normal tracking-[0.03rem] px-[5px] active">Dashboard</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Dashboard Container --}}
    <div class="max-w-[1320px] mx-auto px-4">
        <div class="flex flex-wrap gap-4">
            
            @include('frontend.user.partials.user-nav')
            <!-- Main Dashboard Content -->
            <div class="flex-1 bg-white border border-[#ddd] rounded-lg p-4">
                <h3 class="font-semibold text-lg mb-4">Welcome, {{ Auth::user()->name }}!</h3>

                {{-- Order Summary --}}
                <div class="mb-6">
                    <h4 class="font-semibold text-md">Order Summary</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="border border-gray-300 rounded-lg shadow-md p-4 flex items-center transition-transform transform hover:scale-105">
                            <img src="https://cdn-icons-png.flaticon.com/512/190/190698.png" alt="Total Orders" class="w-12 h-12 mr-4">
                            <div>
                                <h5 class="font-semibold text-lg text-gray-800 mb-1">Total Orders</h5>
                                <p class="text-gray-600 text-2xl font-bold">{{ $totalOrders }}</p>
                            </div>
                        </div>
                        <div class="border border-gray-300 rounded-lg shadow-md p-4 flex items-center transition-transform transform hover:scale-105">
                            <img src="https://cdn-icons-png.flaticon.com/512/190/190698.png" alt="Total Spent" class="w-12 h-12 mr-4">
                            <div>
                                <h5 class="font-semibold text-lg text-gray-800 mb-1">Total Spent</h5>
                                <p class="text-gray-600 text-2xl font-bold">${{ number_format($totalSpent, 2) }}</p>
                            </div>
                        </div>
                    
                        <div class="border border-gray-300 rounded-lg shadow-md p-4 flex items-center transition-transform transform hover:scale-105">
                            <img src="https://cdn-icons-png.flaticon.com/512/190/190698.png" alt="Pending Orders" class="w-12 h-12 mr-4">
                            <div>
                                <h5 class="font-semibold text-lg text-gray-800 mb-1">Pending Orders</h5>
                                <p class="text-gray-600 text-2xl font-bold">{{ $pendingOrders }}</p>
                            </div>
                        </div>
                    
                        <div class="border border-gray-300 rounded-lg shadow-md p-4 flex items-center transition-transform transform hover:scale-105">
                            <img src="https://cdn-icons-png.flaticon.com/512/190/190698.png" alt="Completed Orders" class="w-12 h-12 mr-4">
                            <div>
                                <h5 class="font-semibold text-lg text-gray-800 mb-1">Completed Orders</h5>
                                <p class="text-gray-600 text-2xl font-bold">{{ $completedOrders }}</p>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>

                {{-- Recent Orders --}}
                <div class="mb-6">
                    <h4 class="font-semibold text-lg mb-4">Recent Orders</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @if ($recentOrders && $recentOrders->count())
                            @foreach($recentOrders as $order)
                                <div class="bg-white shadow-lg rounded-lg p-4 border border-gray-200 hover:shadow-xl transition-shadow duration-200">
                                    <h5 class="font-semibold text-xl text-blue-600">Order #{{ $order->id }}</h5>
                                    <p class="text-gray-700 text-base">Total: <span class="font-bold text-green-600">${{ number_format($order->total, 2) }}</span></p>
                                    <p class="text-gray-700 text-base">Status: <span class="font-semibold">{{ ucfirst($order->status) }}</span></p>
                                    
                                    <div class="mt-3 flex space-x-2">
                                        <a href="{{ route('user.order.show', $order->order_number) }}" class="inline-block text-white bg-blue-500 hover:bg-blue-600 rounded-lg px-4 py-2 text-sm font-medium transition duration-200">
                                            View Order
                                        </a>
                                        {{-- <a href="{{ route('order.reorder', $order->id) }}" class="inline-block text-gray-800 bg-gray-200 hover:bg-gray-300 rounded-lg px-4 py-2 text-sm font-medium transition duration-200" title="Reorder this item">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h1m4 0h-1v4h-1m1 4h-3a2 2 0 01-2-2V6a2 2 0 012-2h3a2 2 0 012 2v12a2 2 0 01-2 2z" /></svg>
                                            Reorder
                                        </a>
                                        <a href="{{ route('order.print', $order->id) }}" class="inline-block text-gray-800 bg-gray-200 hover:bg-gray-300 rounded-lg px-4 py-2 text-sm font-medium transition duration-200" title="Print Order">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 16h-8v-6h8v6zm-1-11h-6a2 2 0 00-2 2v1h10v-1a2 2 0 00-2-2z" /></svg>
                                            Print
                                        </a> --}}
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-gray-600">No recent orders found.</p>
                        @endif
                    </div>
                </div>
                
                

                {{-- Recommended Products --}}
                <div>
                    <h4 class="font-semibold text-md">Recommended for You</h4>
                    <div class="grid grid-cols-2 gap-4 mt-2">
                        @foreach($recommendedProducts as $product)
                            <div class="border border-[#ddd] rounded-lg p-2">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-[150px] object-cover rounded-t-lg">
                                <h5 class="font-semibold">{{ $product->name }}</h5>
                                <p class="text-gray-600">${{ $product->price }}</p>
                                <a href="{{ route('product.show', $product->id) }}" class="mt-2 inline-block text-white bg-blue-500 hover:bg-blue-600 rounded px-3 py-1">View</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection