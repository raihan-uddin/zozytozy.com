<x-app-layout>
    <x-slot name="title">
        Invoice #{{ $order->order_number }} - {{ config('app.name', 'Laravel') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div id="invoice" class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="p-8">
                    <!-- Invoice Header -->
                    <header class="flex justify-between items-center border-b pb-6 mb-6">
                        <div>
                            <h2 class="text-3xl font-bold">Invoice</h2>
                            <p class="text-gray-500">Order #{{ $order->order_number }}</p>
                        </div>
                        <div>
                            <a href="{{ route('orders.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">Back to Orders</a>
                            <button onclick="printInvoice()" class="ml-4 bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Print Invoice</button>
                        </div>
                    </header>

                    <!-- Customer & Order Details -->
                    <div class="flex justify-between mb-8">
                        <div>
                            <h3 class="text-lg font-semibold">Customer Details</h3>
                            <p>{{ $order->guest_phone }}</p>
                            <p>{{ $order->guest_email }}</p>
                            <p>{{ $order->guest_phone }}</p>
                            <p>{{ $order->shipping_address }}</p>
                        </div>
                        <div class="text-right">
                            <h3 class="text-lg font-semibold">Order Date</h3>
                            <p>{{ $order->created_at->format('F j, Y, g:i a') }}</p>
                            <p class="font-semibold text-gray-600">Status: 
                                <span class="{{ $order->status === 'completed' ? 'text-green-500' : 'text-red-500' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </p>
                            <p class="font-semibold text-gray-600">Order Total: ${{ number_format($order->total, 2) }}</p>
                        </div>
                    </div>

                    <!-- Order Items Table -->
                    <h4 class="text-lg font-semibold mb-4">Order Items</h4>
                    <table class="w-full border mb-8 text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left">Item Name</th>
                                <th class="px-4 py-2 text-center">Qty</th>
                                <th class="px-4 py-2 text-right">Price</th>
                                <th class="px-4 py-2 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr class="border-t">
                                    <td class="px-4 py-2">
                                        {{ $item->product->name }}
                                        {{-- show item->size if it exists --}}
                                        @if($item->size)
                                            <span class="text-gray-500">({{ $item->size }})</span>
                                        @endif

                                        {{-- show item->color if it exists --}}
                                        @if($item->color)
                                            <span class="text-gray-500">({{ $item->color }})</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 text-center">{{ number_format($item->quantity) }}</td>
                                    <td class="px-4 py-2 text-right">${{ number_format($item->price, 2) }}</td>
                                    <td class="px-4 py-2 text-right">${{ number_format($item->quantity * $item->price, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Order Summary -->
                    <div class="border-t pt-6">
                        <h4 class="text-lg font-semibold mb-2">Order Summary</h4>
                        <div class="grid grid-cols-2 gap-4 text-right">
                            <p>Shipping Charge</p>
                            <p>${{ number_format($order->shipping_cost, 2) }}</p>
                            <p>Tax</p>
                            <p>${{ number_format($order->tax_amount, 2) }}</p>
                            <p class="font-semibold text-lg">Total Amount</p>
                            <p class="font-semibold text-lg">${{ number_format($order->total, 2) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Order Status Update Section -->
                <div class="p-6 bg-gray-100">
                    <h4 class="text-lg font-semibold mb-2">Update Order Status</h4>
                    <form action="{{ route('order.update.status') }}" method="POST">
                        @csrf
                        @method('PUT')
                    
                        <label for="status" class="block mb-1 text-gray-600">Order Status</label>
                        <select id="status" name="status" class="block w-full border-gray-300 rounded-md mb-4">
                            <option value="pending" {{ old('status', $order->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ old('status', $order->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="processing" {{ old('status', $order->status) == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped" {{ old('status', $order->status) == 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered" {{ old('status', $order->status) == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="returned" {{ old('status', $order->status) == 'returned' ? 'selected' : '' }}>Returned</option>
                            <option value="refunded" {{ old('status', $order->status) == 'refunded' ? 'selected' : '' }}>Refunded</option>
                            <option value="canceled" {{ old('status', $order->status) == 'canceled' ? 'selected' : '' }}>Canceled</option>
                            <option value="on_hold" {{ old('status', $order->status) == 'on_hold' ? 'selected' : '' }}>On Hold</option>
                        </select>
                    
                        {{-- hidden order_id --}}
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                    
                        <label for="status_note" class="block mb-1 text-gray-600">Status Note</label>
                        <textarea id="status_note" name="status_note" class="block w-full border-gray-300 rounded-md mb-4">{{ old('status_note', $order->status_note) }}</textarea>
                    
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Update Status</button>
                    </form>
                    
                    <!-- Flash Message Alert -->
                    @if(session('status'))
                        <div class="mt-4 p-4 bg-green-100 text-green-700 rounded-md">
                            {{ session('status') }}
                        </div>
                    @elseif(session('error'))
                        <div class="mt-4 p-4 bg-red-100 text-red-700 rounded-md">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>

                <!-- Order Status Timeline -->
                <div class="p-6 bg-gray-50">
                    <h4 class="text-lg font-semibold mb-4">Order Status Timeline</h4>
                    <ul class="space-y-2">
                        @foreach($order->statuses as $status)
                            <li class="flex items-center">
                                <span class="w-2.5 h-2.5 rounded-full bg-gray-500 mr-4"></span>
                                <span class="text-sm font-medium">{{ $status->status }} - {{ $status->created_at->format('F j, Y, g:i a') }}</span>
                                @if($status->note)
                                    <p class="ml-4 text-sm text-gray-600 italic">Note: {{ $status->note }}</p>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        function printInvoice() {
            const invoiceContent = document.getElementById("invoice").innerHTML;
            const originalContent = document.body.innerHTML;

            document.body.innerHTML = invoiceContent;
            window.print();
            document.body.innerHTML = originalContent;
        }
    </script>

    <style>
        /* Print Styles */
        @media print {
            body * {
                visibility: hidden;
            }
            #invoice, #invoice * {
                visibility: visible;
            }
            #invoice {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
            /* Hide the print button when printing */
            button, a {
                display: none !important;
            }
        }
    </style>
</x-app-layout>
