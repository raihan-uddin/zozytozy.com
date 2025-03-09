<x-app-layout>

    <x-slot name="title">
        {{ $pageTitle ?? config('app.name', 'Laravel') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex justify-between items-center">
            <span>
                {{ __('Create Brand') }}
            </span>
            
            <div class="flex space-x-4">
                <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition">
                    {{ __('Products') }}
                </a>
                <a href="{{ route('categories.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition">
                    {{ __('Categories') }}
                </a>
                <a href="{{ route('tags.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition">
                    {{ __('Tag') }}
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
                            <span class="ml-3 font-medium text-green-800">{{ __('Brand created successfully!') }}</span>
                        </div>
                        <div class="mt-2 text-sm text-green-700">
                            {{ session('success') }}
                        </div>
                    </div>
                    @endif

                    <!-- Create Vendor Form -->
                    <form enctype="multipart/form-data" class="space-y-6" method="POST" action="{{ route('vendors.store') }}" >
                        @csrf
                        
                        <!-- Name -->
                        <div class="flex flex-col">
                            <x-input-label for="name" :value="__('Name')" required />
                            <x-input id="name" class="form-input mt-2" type="text" name="name" :value="old('name')" required autofocus placeholder="Enter Brand name" />
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="flex flex-col">
                            <x-input-label for="description" :value="__('Description')" />
                            <x-textarea id="description" name="description" class="form-textarea mt-2" rows="3" placeholder="Provide a brief description">{{ old('description') }}</x-textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="flex flex-col">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-input id="email" class="form-input mt-2" type="email" name="email" :value="old('email')" placeholder="Enter email address" />
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="flex flex-col">
                            <x-input-label for="phone" :value="__('Phone')" />
                            <x-input id="phone" class="form-input mt-2" type="text" name="phone" :value="old('phone')" placeholder="Enter phone number" />
                            @error('phone')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="flex flex-col">
                            <x-input-label for="address" :value="__('Address')" />
                            <x-input id="address" class="form-input mt-2" type="text" name="address" :value="old('address')" placeholder="Enter address" />
                            @error('address')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Logo -->
                        <div class="flex flex-col">
                            <x-input-label for="logo_src" :value="__('Logo')" />
                            <p class="text-xs text-gray-600">Recommended image size is 100x100 pixels & file type is jpg, jpeg, png. Maximum file size is 2MB.</span></p>
                            <x-input id="logo_src" class="form-input mt-2" type="file" name="logo_src" />
                            @error('logo_src')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Website -->
                        <div class="flex flex-col">
                            <x-input-label for="website" :value="__('Website')" />
                            <x-input id="website" class="form-input mt-2" type="text" name="website" :value="old('website')" placeholder="https://example.com" />
                            @error('website')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="flex flex-col">
                            <x-input-label for="status" :value="__('Status')" required />
                            <x-select id="status" name="status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </x-select>
                            @error('status')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Show in Front -->
                        <div class="flex flex-col">
                            <x-input-label for="show_in_front" :value="__('Show in Front')" required />
                            <x-select id="show_in_front" name="show_in_front">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </x-select>
                            @error('show_in_front')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- home_page_title --}}
                        <div class="flex flex-col">
                            <x-input-label for="home_page_title" :value="__('Home Page Title')" />
                            <x-input id="home_page_title" class="form-input mt-2" type="text" name="home_page_title" :value="old('home_page_title')" placeholder="e.g., 'Welcome to Our Store' or 'Exclusive Deals Just for You!'" />
                            
                            @error('home_page_title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit and Cancel Buttons -->
                        <div class="mt-6 flex justify-between items-center space-x-4">
                            <a href="{{ route('vendors.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition-all duration-200 w-full sm:w-auto text-center">
                                Cancel
                            </a>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition-all duration-200 w-full sm:w-auto text-center">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
