<x-app-layout>
    <x-slot name="title">
        {{ $pageTitle ?? config('app.name', 'Laravel') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex justify-between items-center">
            <span>
                {{ __('Edit Product') }}
            </span>
            
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
                    @if ($errors->any())
                        <div class="bg-red-500 text-white p-4 rounded mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session('success'))
                        <div id="toast"
                             class="fixed top-0 right-0 mt-4 mr-4 bg-green-500 text-white text-sm rounded-lg p-4">
                            {{ session('success') }}
                        </div>
                        <script>
                            setTimeout(() => {
                                const toast = document.getElementById('toast');
                                toast.style.display = 'none';
                            }, 3000);
                        </script>
                    @endif

                    <form action="{{ route('products.update', $product->id) }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div>
                            <div class="grid grid-cols-4 gap-4 mt-4">
                                <!-- Product Name -->
                                <div class="mb-4">
                                    <x-input-label for="name" :value="__('Product Name')" required/>
                                    <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                             :value="old('name', $product->name)" required autofocus/>
                                    @error('name')
                                    <span class="text-red-600 text-sm" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Product Slug -->
                                <div class="mb-4">
                                    <x-input-label for="slug" :value="__('Product Slug')" required/>
                                    <x-input id="slug" name="slug" class="block mt-1 w-full" type="text"
                                             :value="old('slug', $product->slug)" required/>
                                    @error('slug')
                                    <span class="text-red-600 text-sm" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Product SKU -->
                                <div class="mb-4">
                                    <x-input-label for="sku" :value="__('Product SKU')" required/>
                                    <x-input id="sku" name="sku" class="block mt-1 w-full" type="text"
                                             :value="old('sku', $product->sku)"/>
                                    @if($errors->has('sku'))
                                        <span class="text-red-600 text-sm" role="alert">
                                            <strong>{{ $errors->first('sku') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <!-- Brand -->
                                <div class="mb-4">
                                    <div class="flex items-center justify-between">
                                        <x-input-label for="vendor_id" :value="__('Brand')" required/>
                                        <a href="{{ route('vendors.create') }}"
                                            class="text-indigo-600 hover:text-indigo-900 text-xs">Create New Brand</a>
                                    </div>
                                    <x-select id="vendor_id" name="vendor_id" required>
                                        <option value="" disabled>{{ __('Select Brand') }}</option>
                                        @foreach($vendors as $vendor)
                                            <option
                                                value="{{ $vendor->id }}" {{ old('vendor_id', $product->vendor_id) == $vendor->id ? 'selected' : '' }}>{{ $vendor->name }}</option>
                                        @endforeach
                                    </x-select>
                                    @error('vendor')
                                    <span class="text-red-600 text-sm" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Assign to Product Categories -->
                            <div class="grid grid-cols-2 gap-4 mt-4">
                                <div class="mb-4">
                                    <div class="flex items-center justify-between">
                                        <x-input-label for="categories" :value="__('Assign to Categories')" required/>
                                        <a href="{{ route('categories.create') }}"
                                           class="text-indigo-600 hover:text-indigo-900 text-xs">Create New Category</a>
                                    </div>
                                    <x-select id="categories" name="categories[]" class="select2"
                                            multiple required>
                                        @foreach($categories as $category)
                                            <option
                                                value="{{ $category->id }}" {{ in_array($category->id, $product->categories->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </x-select>
                                    @error('categories')
                                    <span class="text-red-600 text-sm" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Assign to Product Tags -->
                                <div class="mb-4">
                                    <div class="flex items-center justify-between">
                                        <x-input-label for="tags" :value="__('Assign to Tags')"/>
                                        <a href="{{ route('tags.create') }}"
                                           class="text-indigo-600 hover:text-indigo-900 text-xs">Create New Tag</a>
                                    </div>
                                    <x-select id="tags" name="tags[]" class="select2" multiple>
                                        @foreach($tags as $tag)
                                            <option
                                                value="{{ $tag->id }}" {{ in_array($tag->id, $product->tags->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $tag->name }}</option>
                                        @endforeach
                                    </x-select>
                                    @error('tags')
                                    <span class="text-red-600 text-sm" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Full Description (Quill WYSIWYG Editor) -->
                            <div class="mb-4">
                                <x-input-label for="full_description" :value="__('Full Description')"/>
                                <div id="full_description_editor" class="block mt-1 w-full editor"
                                     style="height: 300px">
                                    {!! old('full_description', $product->full_description) !!}
                                </div>
                                <textarea name="full_description" id="full_description"
                                          class="hidden">{{ old('full_description', $product->full_description) }}</textarea>
                                @error('full_description')
                                <span class="text-red-600 text-sm" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- price -->
                            <div class="grid grid-cols-5 gap-4 mt-4">
                                <!-- price -->
                                <div class="mb-4">
                                    <x-input-label for="price" :value="__('Price')" required/>
                                    <x-input id="price" name="price" class="block mt-1 w-full" type="text"
                                             :value="old('price', $product->price)" required/>
                                    @error('price')
                                    <span class="text-red-600 text-sm" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- discount_price -->
                                <div class="mb-4">
                                    <x-input-label for="discount_price" :value="__('Special Price')"/>
                                    <x-input id="discount_price" name="discount_price" class="block mt-1 w-full"
                                             type="text" :value="old('discount_price', $product->discount_price)"/>
                                    @error('discount_price')
                                    <span class="text-red-600 text-sm" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- stock_quantity -->
                                <div class="mb-4">
                                    <x-input-label for="stock_quantity" :value="__('Stock Quantity')" required/>
                                    <x-input id="stock_quantity" name="stock_quantity" class="block mt-1 w-full"
                                             type="text" :value="old('stock_quantity', $product->stock_quantity)"/>
                                    @error('stock_quantity')
                                    <span class="text-red-600 text-sm" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!-- in_stock -->
                                <div class="mb-4">
                                    <x-input-label for="in_stock" :value="__('In Stock')" required/>
                                    <x-select id="in_stock" name="in_stock" required>
                                        <option
                                            value="1" {{ old('in_stock', $product->in_stock) == 1 ? 'selected' : '' }}>
                                            Yes
                                        </option>
                                        <option
                                            value="0" {{ old('in_stock', $product->in_stock) == 0 ? 'selected' : '' }}>
                                            No
                                        </option>
                                    </x-select>
                                    @error('in_stock')
                                    <span class="text-red-600 text-sm" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!-- allow_out_of_stock_orders -->
                                <div class="mb-4">
                                    <x-input-label for="allow_out_of_stock_orders"
                                                :value="__('Allow Out of Stock Orders')" required/>
                                    <x-select id="allow_out_of_stock_orders" name="allow_out_of_stock_orders"
                                            required>
                                        <option
                                            value="1" {{ old('allow_out_of_stock_orders', $product->allow_out_of_stock_orders) == 1 ? 'selected' : '' }}>
                                            Yes
                                        </option>
                                        <option
                                            value="0" {{ old('allow_out_of_stock_orders', $product->allow_out_of_stock_orders) == 0 ? 'selected' : '' }}>
                                            No
                                        </option>
                                    </x-select>
                                    @error('allow_out_of_stock_orders')
                                    <span class="text-red-600 text-sm" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Product Additional metadata -->
                            <div class="grid grid-cols-5 gap-4 mt-4">
                                <!-- barcode -->
                                <div class="mb-4">
                                    <x-input-label for="barcode" :value="__('Barcode')"/>
                                    <x-input id="barcode" name="barcode" class="block mt-1 w-full" type="text"
                                             :value="old('barcode', $product->barcode)"/>
                                    @error('barcode')
                                    <span class="text-red-600 text-sm" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!-- weight -->
                                <div class="mb-4">
                                    <x-input-label for="weight" :value="__('Weight')" required/>
                                    <div class="flex items-center border rounded-md shadow-sm">
                                        <!-- Weight Input -->
                                        <input id="weight" name="weight" type="number" step="0.01"
                                               class="block w-full border-none focus:ring-0 focus:outline-none px-3 py-2"
                                               placeholder="Enter weight"
                                               value="{{ old('weight', $product->weight) }}"/>

                                        <!-- Dropdown for Units -->
                                        <select id="weight_unit" name="weight_unit"
                                                class="border-l border-gray-300 bg-gray-50 focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2 rounded-r-md  w-28">
                                            @foreach (\App\Models\Product::WEIGHT_UNIT_ARR as $unitKey)
                                                <option
                                                    value="{{ $unitKey }}" {{ old('weight_unit', $product->weight_unit) == $unitKey ? 'selected' : '' }}>
                                                    {{ strtoupper($unitKey) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @error('weight')
                                    <span class="text-red-600 text-sm" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                    @error('weight_unit')
                                    <span class="text-red-600 text-sm" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- length -->
                                <div class="mb-4">
                                    <x-input-label for="length" :value="__('Length')" required/>
                                    <x-input id="length" name="length" class="block mt-1 w-full" type="number"
                                             :value="old('length', $product->length)"/>
                                    @error('length')
                                    <span class="text-red-600 text-sm" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- width -->
                                <div class="mb-4">
                                    <x-input-label for="width" :value="__('Width')" required/>
                                    <x-input id="width" name="width" class="block mt-1 w-full" type="number"
                                             :value="old('width', $product->width)"/>
                                    @error('width')
                                    <span class="text-red-600 text-sm" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- height -->
                                <div class="mb-4">
                                    <x-input-label for="height" :value="__('Height')" required/>
                                    <x-input id="height" name="height" class="block mt-1 w-full" type="number"
                                             :value="old('height', $product->height)"/>
                                    @error('height')
                                    <span class="text-red-600 text-sm" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Product visibility options -->
                            <div class="grid grid-cols-5 gap-4 mt-4">
                                <!-- is_is_featured -->
                                <div class="mb-4">
                                    <x-input-label for="is_featured" :value="__('Is Featured')" required/>
                                    <x-select id="is_featured" name="is_featured" required>
                                        <option
                                            value="1" {{ old('is_featured', $product->is_featured) == 1 ? 'selected' : '' }}>
                                            Yes
                                        </option>
                                        <option
                                            value="0" {{ old('is_featured', $product->is_featured) == 0 ? 'selected' : '' }}>
                                            No
                                        </option>
                                    </x-select>
                                    @error('is_featured')
                                    <span class="text-red-600 text-sm" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- status: 'draft', 'published', 'archived' -->
                                <div class="mb-4">
                                    <x-input-label for="status" :value="__('Status')" required/>
                                    <x-select id="status" name="status" required>
                                        <option
                                            value="draft" {{ old('status', $product->status) == 'draft' ? 'selected' : '' }}>
                                            Draft
                                        </option>
                                        <option
                                            value="published" {{ old('status', $product->status) == 'published' ? 'selected' : '' }}>
                                            Published
                                        </option>
                                        <option
                                            value="archived" {{ old('status', $product->status) == 'archived' ? 'selected' : '' }}>
                                            Archived
                                        </option>
                                    </x-select>
                                    @error('status')
                                    <span class="text-red-600 text-sm" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Product Featured Image -->
                            <div class="mb-4">
                                <x-input-label for="featured_image" :value="__('Product Featured Image')" required/>
                                <p class="text-xs text-gray-600">Recommended image size is 400x400 pixels & max file
                                    size is 2MB</p>
                                <input type="file" name="featured_image" id="featured_image" class="block mt-1 w-full"
                                       accept="image/*">
                                @error('featured_image')
                                <span class="text-red-600 text-sm" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror

                                <!-- Preview Image -->
                                @if($product->featured_image)
                                    <div class="mt-4">
                                        <img src="{{ asset('storage/' . $product->featured_image) }}"
                                             alt="{{ $product->name }}"
                                             class="w-32 h-32 object-cover">
                                    </div>
                                @endif
                                <!-- Preview Image -->
                                <div id="imagePreview" class="mt-4 hidden">
                                    <img id="preview" class="w-32 h-32 object-cover rounded-md" alt="Preview"/>
                                    <button type="button" id="removeImage" class="mt-2 text-red-600">Remove Image
                                    </button>
                                </div>
                            </div>

                            <!-- Additional Images -->
                            <div class="mb-4">
                                <label class="block text-gray-700">Gallery Images</label>
                                <p class="text-xs text-gray-600">Recommended image size is 400x400 pixels & max file
                                    size is 2MB</p>
                                <input type="file" name="additional_images[]" id="additional_images"
                                       class="block mt-1 w-full" accept="image/*" multiple>
                                @error('additional_images')
                                <span class="text-red-600 text-sm" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror

                                <!-- Existing Images Preview -->
                                <div id="oldAdditionalImagesPreview" class="mt-4 flex flex-wrap">
                                    @foreach($product->images as $image)
                                        <div class="image-container w-32 h-32 relative mr-2 mb-2 group">
                                            <img src="{{ $image->image_url }}" alt="{{ $product->name }}"
                                                 class="w-full h-full object-cover rounded-md transition-transform duration-200 group-hover:scale-105">
                                            <button type="button"
                                                    class="remove-image absolute top-0 right-0 bg-red-600 text-white text-xs rounded-full p-2 shadow-md hover:bg-red-700 transition duration-200 opacity-0 group-hover:opacity-100"
                                                    data-image-id="{{ $image->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Preview Container -->
                                <div id="additionalImagePreview" class="mt-4 grid grid-cols-3 gap-4 hidden">
                                    <!-- Preview Images will be added here -->
                                </div>
                            </div>

                            <!-- Product variants size, color, price, sku, stock -->
                            <div class="mb-4">
                                <x-input-label for="variants" :value="__('Product Variants')"/>
                                <div id="variants" class="block mt-1 w-full">
                                    <div
                                        class="flex flex-wrap gap-4 mb-6 items-start bg-white p-6 rounded-lg shadow-lg">
                                        <div class="flex-1 min-w-[180px]">
                                            <x-input-label for="size" :value="__('Size')"
                                                           class="text-gray-700 font-medium"/>
                                            <div id="variant_weight_group"
                                                 class="flex items-center mt-2 border border-gray-300 rounded-lg focus-within:ring-2 focus-within:ring-indigo-500 focus-within:border-indigo-500 transition duration-200 ease-in-out">
                                                <!-- Size Input -->
                                                <input id="variant_weight" name="variant_weight" type="number"
                                                       step="0.01"
                                                       class="block w-full px-3 py-2 border-none focus:ring-0 focus:outline-none rounded-l-lg"
                                                       placeholder="Enter weight"/>

                                                <!-- Unit Dropdown -->
                                                <select id="variant_weight_unit" name="variant_weight_unit"
                                                        class="px-3 py-2 bg-gray-50 border-l border-gray-300 rounded-r-lg focus:outline-none focus:ring-0 w-28">
                                                    @foreach (\App\Models\Product::WEIGHT_UNIT_ARR as $unitKey)
                                                        <option
                                                            value="{{ $unitKey }}" {{ old('size_unit') == $unitKey ? 'selected' : '' }}>
                                                            {{ strtoupper($unitKey) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('size')
                                            <span class="text-red-600 text-sm mt-1 block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            @error('size_unit')
                                            <span class="text-red-600 text-sm mt-1 block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="flex-1 min-w-[180px]">
                                            <x-input-label for="color" :value="__('Color')"
                                                           class="text-gray-700 font-medium"/>
                                            <x-input id="color"
                                                     class="block mt-2 w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 ease-in-out"
                                                     type="text" placeholder="Enter color"/>
                                        </div>

                                        <div class="flex-1 min-w-[180px]">
                                            <x-input-label for="variant_price" :value="__('Price')"
                                                           class="text-gray-700 font-medium" required/>
                                            <x-input id="variant_price"
                                                     class="block mt-2 w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 ease-in-out"
                                                     type="number" placeholder="Enter price"/>
                                        </div>

                                        <div class="flex-1 min-w-[180px]">
                                            <x-input-label for="variant_sku" :value="__('SKU')"
                                                           class="text-gray-700 font-medium" required/>
                                            <x-input id="variant_sku"
                                                     class="block mt-2 w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 ease-in-out"
                                                     type="text" placeholder="Enter SKU"/>
                                        </div>

                                        <div class="flex-1 min-w-[180px]">
                                            <x-input-label for="stock" :value="__('Stock')"
                                                           class="text-gray-700 font-medium" required/>
                                            <x-input id="stock"
                                                     class="block mt-2 w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 ease-in-out"
                                                     type="number" placeholder="Enter stock"/>
                                        </div>

                                        <div class="flex-shrink-0">
                                            <button type="button" id="addVariant"
                                                    class="mt-6 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded-lg shadow-md focus:ring-2 focus:ring-indigo-500 transition duration-200 ease-in-out">
                                                Add Variant
                                            </button>
                                        </div>
                                    </div>

                                    <div id="variantsPreview" class="mt-4">
                                        <!-- Header with titles -->
                                        <div
                                            class="grid grid-cols-6 gap-2 bg-gray-100 p-2 border border-gray-300 rounded-t-md text-sm shadow-sm">
                                            <div class="font-medium text-gray-700">Size</div>
                                            <div class="font-medium text-gray-700">Color</div>
                                            <div class="font-medium text-gray-700">Price</div>
                                            <div class="font-medium text-gray-700">SKU</div>
                                            <div class="font-medium text-gray-700">Stock</div>
                                            <div class="font-medium text-center text-gray-700">Action</div>
                                        </div>

                                        <!-- Dynamically added variants -->
                                        @foreach($product->variants as $variant)
                                            <div
                                                class="variant-group grid grid-cols-6 gap-2 p-2 border border-gray-200 items-center text-sm shadow-sm hover:shadow-md transition-shadow rounded-md mt-2">
                                                <div>
                                                    <!-- Weight Input with Unit Dropdown -->
                                                    <div
                                                        class="flex items-center border border-gray-300 rounded-lg p-2 mt-2 focus-within:ring-2 focus-within:ring-blue-400 focus-within:border-blue-400 transition duration-150 ease-in-out">
                                                        <input type="number" step="0.01"
                                                               name="variants[{{ $variant->id }}][weight]"
                                                               value="{{ $variant->weight }}"
                                                               placeholder="Enter weight"
                                                               class="block w-full px-3 py-2 border-none focus:ring-0 focus:outline-none rounded-l-lg text-sm"/>

                                                        <select name="variants[{{ $variant->id }}][weight_unit]"
                                                                class="px-3 py-2 bg-gray-50 border-l border-gray-300 rounded-r-lg focus:outline-none focus:ring-0 w-28 text-sm">
                                                            @foreach (\App\Models\Product::WEIGHT_UNIT_ARR as $unitKey)
                                                                <option
                                                                    value="{{ $unitKey }}" {{ $variant->weight_unit === $unitKey ? 'selected' : '' }}>
                                                                    {{ strtoupper($unitKey) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div>
                                                    <input type="text" name="variants[{{ $variant->id }}][color]"
                                                           placeholder="Color"
                                                           value="{{ $variant->color }}"
                                                           class="form-input border border-gray-300 rounded p-2 w-full text-sm focus:border-blue-400 focus:ring focus:ring-blue-200 transition duration-150 ease-in-out">
                                                </div>
                                                <div>
                                                    <input type="text" name="variants[{{ $variant->id }}][price]"
                                                           placeholder="Price"
                                                           value="{{ $variant->price }}"
                                                           class="form-input border border-gray-300 rounded p-2 w-full text-sm text-right focus:border-blue-400 focus:ring focus:ring-blue-200 transition duration-150 ease-in-out">
                                                </div>
                                                <div>
                                                    <input type="text" name="variants[{{ $variant->id }}][sku]"
                                                           placeholder="SKU"
                                                           value="{{ $variant->sku }}"
                                                           class="form-input border border-gray-300 rounded p-2 w-full text-sm focus:border-blue-400 focus:ring focus:ring-blue-200 transition duration-150 ease-in-out">
                                                </div>
                                                <div>
                                                    <input type="text" name="variants[{{ $variant->id }}][stock]"
                                                           placeholder="Stock"
                                                           value="{{ $variant->stock }}"
                                                           class="form-input border border-gray-300 rounded p-2 w-full text-sm text-center focus:border-blue-400 focus:ring focus:ring-blue-200 transition duration-150 ease-in-out">
                                                </div>
                                                <div class="text-center" title="Delete Variant">
                                                    <button type="button"
                                                            class="text-red-500 hover:text-red-700 focus:outline-none focus:ring focus:ring-red-200 rounded transition duration-150 ease-in-out removeVariant text-lg">
                                                        &times;
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items center justify-end mt-4">
                            <x-primary-button>{{ __('Update Product') }}</x-primary-button>
                            {{-- go back --}}
                            <a href="{{ route('products.index') }}"
                               class="ml-4 inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                Go Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet"/>
    <script src="{{ asset('js/select2.min.js') }}"></script>

    <!-- Add Quill's CSS and JS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        const weightUnits = @json(\App\Models\Product::WEIGHT_UNIT_ARR);

        function generateSlug(value) {
            const slug = value.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
            document.getElementById('slug').value = slug;
        }

        function generateUnitOptions(selectedUnit = '') {
            return weightUnits.map(unit => `
                <option value="${unit}" ${selectedUnit === unit ? 'selected' : ''}>
                    ${unit.toUpperCase()}
                </option>
            `).join('');
        }

        function generateVariantInput(uniqueKey, size = '', sizeUnit = '') {
            return `
                <div class="flex items-center border border-gray-300 rounded-lg p-2 mt-2 focus-within:ring-2 focus-within:ring-blue-400 focus-within:border-blue-400 transition duration-150 ease-in-out">
                    <!-- Size Input -->
                    <input type="number" step="0.01"
                        name="variants[${uniqueKey}][size]"
                        value="${size}"
                        placeholder="Enter size"
                        class="block w-full px-3 py-2 border-none focus:ring-0 focus:outline-none rounded-l-lg text-sm" />

                    <!-- Unit Dropdown -->
                    <select name="variants[${uniqueKey}][size_unit]"
                            class="px-3 py-2 bg-gray-50 border-l border-gray-300 rounded-r-lg focus:outline-none focus:ring-0 w-28 text-sm">
                        ${generateUnitOptions(sizeUnit)}
                    </select>
                </div>
            `;
        }

        $(document).ready(function () {
            $('.select2').select2();
        });

        $(document).ready(function () {
            $('#featured_image').change(function (e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        $('#preview').attr('src', event.target.result);
                        $('#imagePreview').removeClass('hidden');
                    }
                    reader.readAsDataURL(file);
                }
            });

            $('#removeImage').click(function () {
                $('#featured_image').val(''); // Clear the file input
                $('#preview').attr('src', ''); // Clear the preview image
                $('#imagePreview').addClass('hidden'); // Hide the preview section
            });
        });

        // addition images preview
        $(document).ready(function () {
            $('#additional_images').change(function () {
                // Clear previous previews
                $('#additionalImagePreview').empty().removeClass('hidden');

                const files = this.files; // Get the selected files
                if (files.length > 0) {
                    // Loop through each file
                    $.each(files, function (index, file) {
                        const reader = new FileReader();

                        // Create a preview for each file
                        reader.onload = function (event) {
                            const previewHtml = `
                            <div class="relative inline-block">
                                <img src="${event.target.result}" class="w-full h-32 object-cover rounded-md border border-gray-300 shadow-md transition-transform duration-200 transform hover:scale-105" alt="Preview">
                                <button type="button" class="absolute top-1 right-1 bg-red-600 text-white rounded-full p-1 transform hover:scale-110 transition-transform duration-200 removeImage">
                                    &times;
                                </button>
                            </div>
                        `;
                            $('#additionalImagePreview').append(previewHtml);
                        };

                        // Read the file as a Data URL
                        reader.readAsDataURL(file);
                    });
                }
            });

            // Remove image preview when the remove button is clicked
            $('#additionalImagePreview').on('click', '.removeImage', function () {
                $(this).closest('div').remove(); // Remove the image preview
                // Hide preview container if no images are left
                if ($('#additionalImagePreview').children().length === 0) {
                    $('#additionalImagePreview').addClass('hidden');
                }
            });
        });


        // gallery images remove
        $(document).ready(function () {
            // Event listener for the remove button
            $('.remove-image').click(function () {
                var imageId = $(this).data('image-id'); // Get the image ID from the button data attribute
                var $imageContainer = $(this).closest('.image-container'); // Get the image container

                // AJAX call to remove the image from the database
                $.ajax({
                    url: '{{ route("remove.image") }}',
                    type: 'POST', // Use the appropriate HTTP method
                    data: {
                        image_id: imageId,
                        _token: '{{ csrf_token() }}' // Include CSRF token if necessary
                    },
                    success: function (response) {
                        // On success, remove the image container from the DOM
                        $imageContainer.remove();
                        alert('Image removed successfully!');
                    },
                    error: function (xhr, status, error) {
                        console.error('Error removing image:', error);
                        alert('Failed to remove the image.');
                    }
                });
            });
        });


        $(document).ready(function () {
            $('#addVariant').click(function () {
                // Get values from the input fields
                const weight = $('#variant_weight').val();
                const weightUnit = $('#variant_weight_unit').val();
                const color = $('#color').val();
                const price = $('#variant_price').val();
                const sku = $('#variant_sku').val();
                const stock = $('#stock').val();
                // color or size any one is must be filled
                if (!weight && !color) {
                    $('#variant_weight_group').css('border', '1px solid red');
                    $('#color').css('border', '1px solid red');
                    alert('Size or Color is required');
                    return;
                }
                if (!price) {
                    $('#variant_price').css('border', '1px solid red');
                    alert('Price is required');
                    return;
                }

                // Generate a unique key for the new variant group (using timestamp)
                const uniqueKey = Date.now();
                // Create a new variant preview
                const variantHtml = `
                    <div class="variant-group grid grid-cols-6 gap-2 p-2 border border-gray-200 items-center text-sm shadow-sm hover:shadow-md transition-shadow rounded-md mt-2">
                        <div>
                            <!-- Weight Input with Unit Dropdown -->
                            <div class="flex items-center border border-gray-300 rounded-lg p-2 mt-2 focus-within:ring-2 focus-within:ring-blue-400 focus-within:border-blue-400 transition duration-150 ease-in-out">
                                <input type="number" step="0.01"
                                    name="variants[${uniqueKey}][weight]"
                                    value="${weight}"
                                    placeholder="Enter weight"
                                    class="block w-full px-3 py-2 border-none focus:ring-0 focus:outline-none rounded-l-lg text-sm" />

                                <select name="variants[${uniqueKey}][weight_unit]"
                                        class="px-3 py-2 bg-gray-50 border-l border-gray-300 rounded-r-lg focus:outline-none focus:ring-0 w-28 text-sm">
                                    ${generateUnitOptions(weightUnit)}
                                </select>
                            </div>
                        </div>
                        <div>
                            <input type="text" name="variants[${uniqueKey}][color]" placeholder="Color" value="${color}" class="form-input border border-gray-300 rounded p-2 w-full text-sm focus:border-blue-400 focus:ring focus:ring-blue-200 transition duration-150 ease-in-out">
                        </div>
                        <div>
                            <input type="text" name="variants[${uniqueKey}][price]" placeholder="Price" value="${price}" class="form-input border border-gray-300 rounded p-2 w-full text-sm text-right focus:border-blue-400 focus:ring focus:ring-blue-200 transition duration-150 ease-in-out">
                        </div>
                        <div>
                            <input type="text" name="variants[${uniqueKey}][sku]" placeholder="SKU" value="${sku}" class="form-input border border-gray-300 rounded p-2 w-full text-sm focus:border-blue-400 focus:ring focus:ring-blue-200 transition duration-150 ease-in-out">
                        </div>
                        <div>
                            <input type="text" name="variants[${uniqueKey}][stock]" placeholder="Stock" value="${stock}" class="form-input border border-gray-300 rounded p-2 w-full text-sm text-center focus:border-blue-400 focus:ring focus:ring-blue-200 transition duration-150 ease-in-out">
                        </div>
                        <div class="text-center" title="Delete Variant">
                            <button type="button" class="text-red-500 hover:text-red-700 focus:outline-none focus:ring focus:ring-red-200 rounded transition duration-150 ease-in-out removeVariant text-lg">&times;</button>
                        </div>
                    </div>
                    `;

                // Append the new variant to the preview section
                $('#variantsPreview').append(variantHtml).removeClass('hidden');

                // Clear input fields
                $('#variant_weight_group').css('border', '1px solid #e5e7eb').val('');
                $('#color').css('border', '1px solid #e5e7eb').val('');
                $('#variant_price').css('border', '1px solid #e5e7eb').val('');

                $('#variant_sku').val('');
                $('#stock').val('');
            });

            // Remove variant from the preview
            $('#variantsPreview').on('click', '.removeVariant', function () {
                $(this).closest('.variant-group').remove();
                // Hide the preview section if no variants are left
                if ($('#variantsPreview').children().length === 0) {
                    $('#variantsPreview').addClass('hidden');
                }
            });
        });


        const toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
            ['blockquote', 'code-block'],
            ['link', 'image', 'video', 'formula'],

            [{'header': 1}, {'header': 2}],               // custom button values
            [{'list': 'ordered'}, {'list': 'bullet'}, {'list': 'check'}],
            [{'script': 'sub'}, {'script': 'super'}],      // superscript/subscript
            [{'indent': '-1'}, {'indent': '+1'}],          // outdent/indent
            [{'direction': 'rtl'}],                         // text direction

            [{'size': ['small', false, 'large', 'huge']}],  // custom dropdown
            [{'header': [1, 2, 3, 4, 5, 6, false]}],

            [{'color': []}, {'background': []}],          // dropdown with defaults from theme
            [{'font': []}],
            [{'align': []}],

            // ['clean']                                         // remove formatting button
        ];
        <!-- Initialize Quill editor with advance -->

        // Full Description Editor

        const fullDescriptionEditor = new Quill('#full_description_editor', {
            theme: 'snow',
            modules: {
                toolbar: toolbarOptions
            }
        });

        fullDescriptionEditor.on('text-change', function () {
            const html = fullDescriptionEditor.root.innerHTML;
            document.getElementById('full_description').value = html;
        });

    </script>

</x-app-layout>
