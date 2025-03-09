<x-app-layout>

    <x-slot name="title">
        {{ $pageTitle ?? config('app.name', 'Laravel') }}
    </x-slot>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex justify-between items-center">
            <span>
                {{ __('Update Category') }}
            </span>

            <!-- Right side: Products, Tags, Brand -->
            <div class="flex space-x-4">
                <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition">
                    {{ __('Products') }}
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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($errors->any())
                        <div class="mb-4">
                            <div class="font-medium text-red-600">{{ __('Whoops! Something went wrong.') }}</div>
                            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('success'))
                    <div class="mb-4 p-4 bg-green-50 border border-green-300 rounded-lg shadow-md">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-10.707a1 1 0 00-1.414-1.414L9 9.586 7.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span class="ml-3 font-medium text-green-800">{{ __('Category created successfully!') }}</span>
                        </div>
                        <div class="mt-2 text-sm text-green-700">
                            {{ session('success') }}
                        </div>
                    </div>
                    @endif
                    <!-- Update Category Form -->
                    <form x-data="categoryForm()" @submit.prevent="submitForm" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <input type="hidden" x-model="categoryId" />

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" required />
                            <x-input id="name" x-model="name" @input="generateSlug" class="block mt-1 w-full" type="text" required autofocus />
                            <span x-show="errors.name" class="text-red-600 text-sm" x-text="errors.name"></span>
                        </div>

                        <!-- Slug -->
                        <div>
                            <x-input-label for="slug" :value="__('Slug')" required />
                            <x-input id="slug" x-model="slug" class="block mt-1 w-full" type="text" readonly required />
                            <span x-show="errors.slug" class="text-red-600 text-sm" x-text="errors.slug"></span>
                        </div>

                        <!-- Order Column -->
                        <div>
                            <x-input-label for="order_column" :value="__('Order Column')" required />
                            <x-input id="order_column" x-model="order_column" class="block mt-1 w-full" type="number" required />
                            <span x-show="errors.order_column" class="text-red-600 text-sm" x-text="errors.order_column"></span>
                        </div>

                        <!-- Assign to Menus -->
                        <div>
                            <x-input-label for="menus" :value="__('Assign to Menus')" />
                            <select x-model="menus" id="menus" class="block mt-1 w-full" multiple>
                                @foreach($menus as $menu)
                                    <option value="{{ $menu->id }}" >{{ $menu->name }}</option>
                                @endforeach
                            </select>
                            <span x-show="errors.menus" class="text-red-600 text-sm" x-text="errors.menus"></span>
                        </div>

                        <!-- Show on sections -->
                        <div class="grid grid-cols-4 gap-4 mt-4">
                            <label>
                                <input type="checkbox" x-model="is_active" class="form-checkbox h-5 w-5 text-indigo-600">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Is Active') }}</span>
                            </label>
                            <label>
                                <input type="checkbox" x-model="is_menu" class="form-checkbox h-5 w-5 text-indigo-600">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Is Menu') }}</span>
                            </label>
                            <label>
                                <input type="checkbox" x-model="show_on_nav_menu" class="form-checkbox h-5 w-5 text-indigo-600">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Show on Nav Menu') }}</span>
                            </label>
                            <label>
                                <input type="checkbox" x-model="show_on_home" class="form-checkbox h-5 w-5 text-indigo-600">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Show on Home') }}</span>
                            </label>
                            <label>
                                <input type="checkbox" x-model="show_on_footer" class="form-checkbox h-5 w-5 text-indigo-600">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Show on Footer') }}</span>
                            </label>
                            <label>
                                <input type="checkbox" x-model="show_on_sidebar" class="form-checkbox h-5 w-5 text-indigo-600">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Show on Sidebar') }}</span>
                            </label>
                            <label>
                                <input type="checkbox" x-model="show_on_slider" class="form-checkbox h-5 w-5 text-indigo-600">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Show on Slider') }}</span>
                            </label>
                            <label>
                                <input type="checkbox" x-model="show_on_top" class="form-checkbox h-5 w-5 text-indigo-600">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Show on Top') }}</span>
                            </label>
                            <label>
                                <input type="checkbox" x-model="show_on_bottom" class="form-checkbox h-5 w-5 text-indigo-600">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Show on Bottom') }}</span>
                            </label>
                        </div>

                        <!-- Icon -->
                        <div>
                            <x-input-label for="icon" :value="__('Icon')" />
                            <x-input id="icon" x-model="icon" class="block mt-1 w-full" type="text" />
                            <span x-show="errors.icon" class="text-red-600 text-sm" x-text="errors.icon"></span>
                        </div>

                        <!-- Image -->
                        <div>
                            <x-input-label for="image" :value="__('Image')" />
                            <p class="text-xs text-gray-600">Recommended image size is 300x300 pixels (JPG, PNG) and maximum file size is 2MB.</p>   
                            <input id="image" type="file" @change="fileChanged" class="block mt-1 w-full" accept="image/jpeg, image/jpg, image/png" />
                            <span x-show="errors.image" class="text-red-600 text-sm" x-text="errors.image"></span>

                            <!-- Show Previous Image -->
                            @if($category->image) <!-- Check if there is an existing image -->
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $category->image) }}" alt="Uploaded Image" class="w-32 h-32 object-cover rounded-md" />
                                    <p class="text-sm text-gray-500 mt-1">Uploaded Image</p>
                                </div>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end">
                            <x-button class="ml-4">
                                {{ __('Update Category') }}
                            </x-button>
                            {{-- go back --}}
                            <a href="{{ route('categories.index') }}" class="ml-4 text-sm text-gray-600 underline">Go back</a>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

    <script>
        function categoryForm() {
            return {
                categoryId: {{ $category->id }},
                name: '{{ $category->name }}',
                slug: '{{ $category->slug }}',
                order_column: {{ $category->order_column }},
                menus: {{ json_encode($category->menus->pluck('id')) }},
                is_menu: {{ $category->is_menu ? 'true' : 'false' }},
                is_active: {{ $category->is_active ? 'true' : 'false' }},
                show_on_home: {{ $category->show_on_home ? 'true' : 'false' }},
                show_on_nav_menu: {{ $category->show_on_nav_menu ? 'true' : 'false' }},
                show_on_footer: {{ $category->show_on_footer ? 'true' : 'false' }},
                show_on_sidebar: {{ $category->show_on_sidebar ? 'true' : 'false' }},
                show_on_slider: {{ $category->show_on_slider ? 'true' : 'false' }},
                show_on_top: {{ $category->show_on_top ? 'true' : 'false' }},
                show_on_bottom: {{ $category->show_on_bottom ? 'true' : 'false' }},
                icon: '{{ $category->icon }}',
                image: null,
                errors: {},

                generateSlug() {
                    this.slug = this.name.toLowerCase().replace(/\s+/g, '-').replace(/[^\w\-]+/g, '');
                },

                fileChanged(event) {
                    this.image = event.target.files[0];
                },

                async submitForm() {
                    let formData = new FormData();
                    formData.append('_method', 'PUT'); // Add method spoofing
                    formData.append('name', this.name);
                    formData.append('slug', this.slug);
                    formData.append('order_column', this.order_column);
                    this.menus.forEach(menu => formData.append('menus[]', menu));

                    formData.append('is_menu', this.is_menu ? 1 : 0);
                    formData.append('is_active', this.is_active ? 1 : 0);
                    formData.append('show_on_home', this.show_on_home ? 1 : 0);
                    formData.append('show_on_nav_menu', this.show_on_nav_menu ? 1 : 0);
                    formData.append('show_on_footer', this.show_on_footer ? 1 : 0);
                    formData.append('show_on_sidebar', this.show_on_sidebar ? 1 : 0);
                    formData.append('show_on_slider', this.show_on_slider ? 1 : 0);
                    formData.append('show_on_top', this.show_on_top ? 1 : 0);
                    formData.append('show_on_bottom', this.show_on_bottom ? 1 : 0);
                    formData.append('icon', this.icon);

                    if (this.image) {
                        formData.append('image', this.image);
                    }

                    try {
                        const response = await axios.post("{{ route('categories.update', $category->id) }}", formData);
                        alert('Category updated successfully!');
                        window.location.href = "{{ route('categories.index') }}"; // Redirect after successful update
                    } catch (error) {
                        this.errors = error.response.data.errors || {};
                    }
                }
            }
        }
    </script>
</x-app-layout>
