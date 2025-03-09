<x-app-layout>

    <x-slot name="title">
        {{ $pageTitle ?? config('app.name', 'Laravel') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $pageTitle ?? config('app.name', 'Laravel') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="p-6">
                    <!-- Success Message -->
                    @if(session('success'))
                        <div id="toast" class="fixed top-4 right-4 bg-green-500 text-white text-sm rounded-lg shadow-md p-4 z-50">
                            {{ session('success') }}
                        </div>
                        <script>
                            setTimeout(() => {
                                document.getElementById('toast')?.remove();
                            }, 3000);
                        </script>
                    @endif
    
                    <!-- Filter Buttons -->
                    <div class="flex flex-wrap justify-center gap-3 mb-6">
                        <a href="{{ route('orders.index') }}" class="filter-button px-5 py-2 rounded-full bg-gray-600 hover:bg-gray-700 text-white shadow-md transition duration-200">All</a>
                        <a href="{{ route('orders.index', ['status' => 'pending']) }}" class="filter-button px-5 py-2 rounded-full bg-yellow-500 hover:bg-yellow-600 text-white shadow-md transition duration-200">Pending</a>
                        <a href="{{ route('orders.index', ['status' => 'confirmed']) }}" class="filter-button px-5 py-2 rounded-full bg-blue-500 hover:bg-blue-600 text-white shadow-md transition duration-200">Confirmed</a>
                        <a href="{{ route('orders.index', ['status' => 'processing']) }}" class="filter-button px-5 py-2 rounded-full bg-orange-500 hover:bg-orange-600 text-white shadow-md transition duration-200">Processing</a>
                        <a href="{{ route('orders.index', ['status' => 'shipped']) }}" class="filter-button px-5 py-2 rounded-full bg-teal-500 hover:bg-teal-600 text-white shadow-md transition duration-200">Shipped</a>
                        <a href="{{ route('orders.index', ['status' => 'delivered']) }}" class="filter-button px-5 py-2 rounded-full bg-green-500 hover:bg-green-600 text-white shadow-md transition duration-200">Delivered</a>
                        <a href="{{ route('orders.index', ['status' => 'returned']) }}" class="filter-button px-5 py-2 rounded-full bg-purple-500 hover:bg-purple-600 text-white shadow-md transition duration-200">Returned</a>
                        <a href="{{ route('orders.index', ['status' => 'refunded']) }}" class="filter-button px-5 py-2 rounded-full bg-pink-500 hover:bg-pink-600 text-white shadow-md transition duration-200">Refunded</a>
                        <a href="{{ route('orders.index', ['status' => 'canceled']) }}" class="filter-button px-5 py-2 rounded-full bg-red-500 hover:bg-red-600 text-white shadow-md transition duration-200">Canceled</a>
                        <a href="{{ route('orders.index', ['status' => 'on_hold']) }}" class="filter-button px-5 py-2 rounded-full bg-gray-700 hover:bg-gray-800 text-white shadow-md transition duration-200">On Hold</a>
                    </div>
    
                    <!-- Orders Cards -->
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                        @if($orders->isEmpty())
                            <div class="bg-white border border-gray-200 rounded-lg shadow-lg p-6 text-center">
                                <!-- Icon -->
                                <div class="flex justify-center mb-4">
                                    <div class="bg-blue-100 text-blue-500 w-16 h-16 flex items-center justify-center rounded-full shadow-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12h3m-6 0h.01M9 12H6m9 5H9m10 4H5a2 2 0 01-2-2V7a2 2 0 012-2h3l2-2h4l2 2h3a2 2 0 012 2v12a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                </div>

                                <!-- Message -->
                                <h2 class="text-lg font-semibold text-gray-700">No Orders Found</h2>
                                <p class="text-sm text-gray-500 mt-2">It seems like you haven’t placed any orders yet.</p>
                            </div>
                        @endif

                        @foreach($orders as $order)
                            <div class="bg-white border border-gray-200 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                                <div class="p-4">
                                    <!-- Order ID -->
                                    <div class="flex justify-between items-center">
                                        <h3 class="font-semibold text-gray-700 text-lg">Order #{{ $order->id }}</h3>
                                        <span class="text-sm text-gray-500">{{ $order->created_at->diffForHumans() }}</span>
                                    </div>
    
                                    <!-- Order Details -->
                                    <div class="mt-2 space-y-2 text-sm text-gray-600">
                                        <p><strong>Phone:</strong> {{ $order->guest_phone }}</p>
                                        <p><strong>Items:</strong> {{ $order->total_items }}</p>
                                        <p><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>
                                        <p>
                                            <strong>Payment:</strong> 
                                            <span class="{{ $order->payment_status === 'paid' ? 'text-green-600 font-medium' : 'text-red-600 font-medium' }}">
                                                {{ ucfirst($order->payment_status) }}
                                            </span>
                                        </p>
                                        <p>
                                            <strong>Status:</strong> 
                                            <span class="px-2 py-1 rounded-full text-xs font-medium
                                                @if($order->status === 'pending') bg-yellow-100 text-yellow-700
                                                @elseif($order->status === 'confirmed') bg-blue-100 text-blue-700
                                                @elseif($order->status === 'shipped') bg-teal-100 text-teal-700
                                                @elseif($order->status === 'delivered') bg-green-100 text-green-700
                                                @elseif($order->status === 'returned') bg-purple-100 text-purple-700
                                                @elseif($order->status === 'refunded') bg-pink-100 text-pink-700
                                                @elseif($order->status === 'canceled') bg-red-100 text-red-700
                                                @elseif($order->status === 'on_hold') bg-gray-100 text-gray-700
                                                @endif">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </p>
                                    </div>
    
                                    <!-- View Button -->
                                    <div class="mt-4">
                                        <a href="{{ route('order.show', $order->id) }}" class="block text-center bg-blue-500 hover:bg-blue-600 text-white text-sm py-2 rounded-lg shadow-md transition duration-200">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
    
                    <!-- Pagination -->
                    <div class="mt-8 flex justify-center">
                        <div class="inline-flex items-center space-x-2 bg-white shadow-md p-3 rounded-lg">
                            <!-- Previous Page Link -->
                            @if ($orders->onFirstPage())
                                <span class="px-4 py-2 text-gray-400 bg-gray-200 rounded-full cursor-not-allowed">
                                    &larr; Previous
                                </span>
                            @else
                                <a href="{{ $orders->previousPageUrl() }}" class="px-4 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-600 transition duration-200">
                                    &larr; Previous
                                </a>
                            @endif
                    
                            <!-- Pagination Elements -->
                            @foreach ($orders->links()->elements[0] as $page => $url)
                                @if ($page == $orders->currentPage())
                                    <span class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-full shadow-md">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-full hover:bg-blue-500 hover:text-white transition duration-200">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                    
                            <!-- Next Page Link -->
                            @if ($orders->hasMorePages())
                                <a href="{{ $orders->nextPageUrl() }}" class="px-4 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-600 transition duration-200">
                                    Next &rarr;
                                </a>
                            @else
                                <span class="px-4 py-2 text-gray-400 bg-gray-200 rounded-full cursor-not-allowed">
                                    Next &rarr;
                                </span>
                            @endif
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    
    <style>
        .filter-button {
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .filter-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .filter-button:active {
            transform: translateY(1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

    </style>
</x-app-layout>
