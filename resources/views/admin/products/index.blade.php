<x-app-layout>
    <x-slot name="title">
        {{ $pageTitle ?? config('app.name', 'Laravel') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex justify-between items-center">
            <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">
                {{ __('Create Product') }}
            </a>

            <!-- Right side: Categories, Tags, Brand -->
            <div class="flex space-x-4">
                <a href="{{ route('categories.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition">
                    {{ __('Categories') }}
                </a>

                <a href="{{ route('tags.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition">
                    {{ __('Tags') }}
                </a>

                <a href="{{ route('vendors.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition">
                    {{ __('Brand') }}
                </a>
            </div>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('success'))
                        <div id="toast" class="fixed top-0 right-0 mt-4 mr-4 bg-green-500 text-white text-sm rounded-lg p-4">
                            {{ session('success') }}
                        </div>
                        <script>
                            setTimeout(() => {
                                const toast = document.getElementById('toast');
                                toast.style.display = 'none';
                            }, 3000);
                        </script>
                    @endif

                    <!-- Filters and Sorting -->
                    <div class="mb-4">
                        <form method="GET" action="{{ route('products.index') }}">
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-4">
                                <!-- Search by name -->
                                <x-text-input id="name"  type="text" name="filter[name]"  placeholder="Search by name" value="{{ $filter['name'] ?? '' }}" />
                                <!-- Min price -->
                                <x-text-input id="min_price" type="number" name="filter[min_price]" placeholder="Min price" value="{{ $filter['min_price'] ?? '' }}" />
                                <!-- Max price -->
                                <x-text-input id="max_price" type="number" name="filter[max_price]" placeholder="Max price" value="{{ $filter['max_price'] ?? '' }}" />
                                <!-- Filter by status -->
                                <x-select name="filter[status]">
                                    <option value="">{{ __('Filter by status') }}</option>
                                    <option value="draft" {{ ($filter['status'] ?? '') == 'draft' ? 'selected' : '' }}>{{ __('Draft') }}</option>
                                    <option value="published" {{ ($filter['status'] ?? '') == 'published' ? 'selected' : '' }}>{{ __('Published') }}</option>
                                    <option value="archived" {{ ($filter['status'] ?? '') == 'archived' ? 'selected' : '' }}>{{ __('Archived') }}</option>
                                </x-select>
                                <!-- Filter by category -->

                                <x-select name="filter[category]">
                                    <option value="">{{ __('Filter by category') }}</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ ($filter['category'] ?? '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </x-select>
                                <!-- Filter and Reset buttons -->
                                <div class="flex space-x-2">
                                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md w-full">{{ __('Filter') }}</button>
                                    <a href="{{ route('products.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md w-full text-center">{{ __('Reset') }}</a>
                                </div>
                            </div>

                            <!-- Sorting section -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-4">
                                <!-- Sort by field -->
                                <x-select name="sort_by">
                                    <option value="">{{ __('Sort by') }}</option>
                                    <option value="name" {{ ($filter['sort_by'] ?? '') == 'name' ? 'selected' : '' }}>{{ __('Name') }}</option>
                                    <option value="price" {{ ($filter['sort_by'] ?? '') == 'price' ? 'selected' : '' }}>{{ __('Price') }}</option>
                                    <option value="created_at" {{ ($filter['sort_by'] ?? '') == 'created_at' ? 'selected' : '' }}>{{ __('Created At') }}</option>
                                </x-select>

                                <!-- Sort direction field -->
                                <x-select name="sort_direction">
                                    <option value="asc" {{ ($filter['sort_direction'] ?? 'asc') == 'asc' ? 'selected' : '' }}>{{ __('Ascending') }}</option>
                                    <option value="desc" {{ ($filter['sort_direction'] ?? 'asc') == 'desc' ? 'selected' : '' }}>{{ __('Descending') }}</option>
                                </x-select>

                                <!-- Sort button -->
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md w-full">{{ __('Sort') }}</button>
                            </div>
                        </form>
                    </div>


                    <!-- Pagination Controls -->
                    <div class="mt-4 mb-4">
                        {{ $products->links() }} <!-- This will render the pagination controls -->
                    </div>

                    <!-- Products Display -->
                    <div x-data="{ showModal: false, imageUrl: '' }" class="overflow-x-auto">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach($products as $product)
                                <div class="border border-gray-200 rounded-lg p-4 shadow-sm hover:shadow-lg transition duration-150 ease-in-out bg-white">
                                    <div class="flex justify-center mb-4">
                                        @if($product->image_url)
                                            <div class="relative w-24 h-24 overflow-hidden rounded-md border border-gray-200">
                                                <img 
                                                    {{-- src="{{ asset($product->image_url) }}"  --}}
                                                    data-src="{{ asset($product->image_url) }}"
                                                    alt="{{ $product->name }}" 
                                                    class="w-full h-full object-cover transition-transform duration-300 ease-in-out transform hover:scale-105 cursor-pointer lozad"
                                                    @click="showModal = true; imageUrl = '{{ asset($product->image_url) }}'"
                                                >
                                            </div>
                                        @else
                                            <span class="text-gray-500">{{ __('No Image') }}</span>
                                        @endif
                                    </div>
                                    <h4 class="font-semibold text-lg text-gray-800 mb-1">
                                        <a href="{{ route('products.show', $product->id) }}" class="hover:underline">{{ $product->name }}</a>
                                    </h4>
                                    <p class="text-gray-600 text-sm mb-1">SKU: {{ $product->sku ?? 'N/A' }}</p>
                                    <p class="text-gray-800 font-bold text-sm mb-1">Price: ${{ number_format($product->price, 2) }}</p>
                                    <p class="text-gray-600 text-sm mb-1">Status: <span class="{{ $product->status == 'published' ? 'text-green-600' : 'text-red-600' }}">{{ ucfirst($product->status) }}</span></p>
                                    <p class="text-gray-600 text-sm">Stock: {{ $product->stock_quantity > 0 ? $product->stock_quantity . ' in stock' : 'Out of stock' }}</p>

                                    <div class="mt-2 mb-4">
                                        @foreach($product->categories as $category)
                                            <a href="{{ route('products.index', ['filter[category]' => $category->id]) }}" class="bg-blue-500 text-white text-xs font-semibold mr-2 mb-2 px-3 py-1 rounded-full transition duration-200 ease-in-out transform hover:bg-blue-600 hover:scale-105 cursor-pointer">
                                                {{ $category->name }}
                                            </a>
                                        @endforeach
                                    </div>

                                    <div class="mt-4 flex justify-between">
                                        <a href="{{ route('products.edit', $product->id) }}" class="text-blue-600 hover:underline text-xs flex items-center">
                                            <i class="fas fa-edit mr-1"></i> Edit
                                        </a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirmDelete(event, '{{ $product->name }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline text-xs flex items-center">
                                                <i class="fas fa-trash mr-1"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Global Modal -->
                        <div x-show="showModal" 
                            x-transition 
                            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-75 z-50"
                            @click.away="showModal = false"
                            @keydown.escape.window="showModal = false"
                            style="display: none;">
                            <div class="relative bg-white rounded-md p-4">
                                <button 
                                    @click="showModal = false" 
                                    class="absolute top-0 right-0 mt-2 mr-2 text-white text-2xl font-bold bg-red-500 hover:bg-red-700 transition duration-200 ease-in-out p-2 rounded-full shadow-md transform hover:scale-105"
                                >
                                    &times;
                                </button>

                                <img :src="imageUrl" alt="Product Image" class="max-w-full max-h-screen rounded-md shadow-lg"> <!-- Optional shadow for better visibility -->
                            </div>
                        </div>

                    </div>


                    <!-- Pagination Controls -->
                    <div class="mt-4">
                        {{ $products->links() }} <!-- This will render the pagination controls -->
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    

    <!-- Global Modal -->
    <div x-show="showModal" 
         x-transition 
         class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-75 z-50"
         @click.away="showModal = false"
         @keydown.escape.window="showModal = false"
         style="display: none;">
        <div class="relative">
            <button @click="showModal = false" class="absolute top-0 right-0 mt-2 mr-2 text-white text-2xl font-bold">
                &times;
            </button>
            <img :src="imageUrl" alt="Product Image" class="max-w-full max-h-screen rounded-md">
        </div>
    </div>
</div>

    <script>
        function confirmDelete(event, productName) {
            event.preventDefault();
            if (confirm('Are you sure you want to delete the product "' + productName + '"?')) {
                const form = event.target;
                form.submit();
            }
        }
    </script>
</x-app-layout>
