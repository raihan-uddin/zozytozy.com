<x-app-layout>
    
    <x-slot name="title">
        {{ $product->name ?? config('app.name', 'Laravel') }}
    </x-slot>

    <x-slot name="header"> 
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Product Details') }}
            </h2>
            <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('products.index') }}" 
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Back') }}
            </a>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 space-y-6">
                    <h3 class="text-2xl font-bold">{{ $product->name }}</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Product Image --}}
                        @if($product->image_url)
                            <div>
                                <img 
                                    data-src="{{ asset($product->image_url) }}"
                                    {{-- src="{{ asset($product->image_url) }}"  --}}
                                    alt="{{ $product->name }}" 
                                    class="rounded-lg w-full object-cover lozad">
                            </div>
                        @endif

                        {{-- Product Info --}}
                        <div>
                            <div class="mb-2">
                                <strong>Slug:</strong> <span>{{ $product->slug }}</span>
                            </div>
                            <div class="mb-2">
                                <strong>Brand:</strong> <span>{{ $product->vendor ? $product->vendor->name : 'N/A'}}</span>
                            </div>
                            <div class="mb-2">
                                <strong>SKU:</strong> <span>{{ $product->sku }}</span>
                            </div>
                            <div class="mb-4">
                                <strong class="text-lg">Categories:</strong>
                                <div class="flex flex-wrap mt-2">
                                    @foreach($product->categories as $category)
                                        <a href="{{ route('products.index', ['filter[category]' => $category->id]) }}" class="bg-blue-500 text-white text-xs font-semibold mr-2 mb-2 px-3 py-1 rounded-full transition duration-200 ease-in-out transform hover:bg-blue-600 hover:scale-105 cursor-pointer">
                                            {{ $category->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>                                                                       
                            <div class="mb-4">
                                <strong class="text-lg">Tags:</strong>
                                <div class="flex flex-wrap mt-2">
                                    @foreach($product->tags as $tag)
                                        <span class="bg-green-500 text-white text-xs font-semibold mr-2 mb-2 px-3 py-1 rounded-full transition duration-200 ease-in-out transform hover:bg-green-600 hover:scale-105 cursor-pointer">
                                            {{ $tag->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>                           
                            
                            <div class="mb-2">
                                <strong>Status:</strong> 
                                <span class="{{ $product->status === 'published' ? 'text-green-500' : ($product->status === 'draft' ? 'text-yellow-500' : 'text-red-500') }}">
                                    {{ ucfirst($product->status) }}
                                </span>
                            </div>
                            
                            <div class="mb-2">
                                <strong>Published At:</strong> 
                                <span title="{{ $product->published_at }}"  class="{{ $product->published_at ? '' : 'text-red-500 font-bold' }}">
                                    @if($product->published_at)
                                        {{ \Carbon\Carbon::parse($product->published_at)->diffForHumans() }}
                                    @else
                                        Not yet published
                                    @endif
                                </span>
                            </div>
                            
                            <div class="mb-2">
                                <strong>Price:</strong> <span>${{ number_format($product->price, 2) }}</span>
                            </div>
                            <div class="mb-2">
                                <strong>Stock Quantity:</strong> <span>{{ $product->stock_quantity > 0 ? $product->stock_quantity . ' in stock' : 'Out of stock' }}</span>
                            </div>
                            <div class="mb-2">
                                <strong>Allow Out of Stock Orders:</strong> <span>{{ $product->allow_out_of_stock_orders ? 'Yes' : 'No' }}</span>
                            </div>
                        </div>
                    </div>
                    {{-- Variants Section --}}
                    @if($product->variants->isNotEmpty())
                    <div class="mt-6">
                        <div class="flex items-center">
                            <hr class="flex-grow border-t border-gray-300">
                            <h2 class="mx-4 text-2xl font-bold text-gray-800">Variants</h2>
                            <hr class="flex-grow border-t border-gray-300">
                        </div>
                        <div class="overflow-x-auto rounded-lg shadow-lg border border-gray-300 mt-4">
                            <table class="min-w-full bg-white transition-shadow duration-300 hover:shadow-xl">
                                <thead class="bg-gray-200 text-gray-700 uppercase text-xs">
                                    <tr>
                                        <th class="px-6 py-4 text-left">Size</th>
                                        <th class="px-6 py-4 text-left">Color</th>
                                        <th class="px-6 py-4 text-left">SKU</th>
                                        <th class="px-6 py-4 text-left">Price</th>
                                        <th class="px-6 py-4 text-left">Stock Quantity</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-800 text-sm">
                                    @foreach($product->variants as $variant)
                                        <tr class="border-b transition-colors duration-200 hover:bg-gray-50">
                                            <td class="px-6 py-4">{{ $variant->size }}</td>
                                            <td class="px-6 py-4 flex items-center">
                                                <!-- Color badge -->
                                                <div class="w-6 h-6 rounded-full mr-2" style="background-color: {{ $variant->color }};"></div>
                                                <span class="text-gray-600">{{ $variant->color }}</span>
                                            </td>
                                            <td class="px-6 py-4">{{ $variant->sku }}</td>
                                            <td class="px-6 py-4 font-semibold">${{ number_format($variant->price, 2) }}</td>
                                            <td class="px-6 py-4">
                                                <span class="{{ $variant->stock_quantity > 0 ? 'text-green-600' : 'text-red-600' }}">
                                                    {{ $variant->stock_quantity > 0 ? $variant->stock_quantity . ' in stock' : 'Out of stock' }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif

                    {{-- Descriptions --}}
                    <div class="space-y-4">
                        <div class="flex items-center">
                                <hr class="flex-grow border-t border-gray-300">
                                <h2 class="mx-4 text-2xl font-bold text-gray-800">Description</h2>
                                <hr class="flex-grow border-t border-gray-300">
                            </div>
                            <p class="mt-1 text-gray-700">{!! $product->full_description !!}</p>
                        </div>
                    </div>

                    {{-- Additional Images --}}
                    @if($product->images->isNotEmpty())
                        <div class="mt-6  pl-3 pr-3 pb-3">
                            <div class="flex items-center">
                                <hr class="flex-grow border-t border-gray-300">
                                <h2 class="mx-4 text-2xl font-bold text-gray-800">Gallery Images</h2>
                                <hr class="flex-grow border-t border-gray-300">
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-2">
                                @foreach($product->images as $image)
                                    <div class="rounded overflow-hidden shadow">
                                        <img 
                                        data-src="{{ asset($image->image_url) }}"
                                        {{-- src="{{ asset($image->image_url) }}"  --}}
                                        alt="{{ $image->caption }}" class="w-full h-32 object-contain lozad">
                                        <p class="text-sm text-gray-600 text-center">{{ $image->caption }}</p>
                                    </div>                                
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Actions --}}
                    <div class="mt-6 flex space-x-4 pb-3 pl-3">
                        <a href="{{ route('products.edit', $product->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit Product</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirmDelete(event, '{{ $product->name }}');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
