<x-app-layout>

    <x-slot name="title">
        {{ $pageTitle ?? config('app.name', 'Laravel') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Banner') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
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
                            <span class="ml-3 font-medium text-green-800">{{ __('Banner created successfully!') }}</span>
                        </div>
                        <div class="mt-2 text-sm text-green-700">
                            {{ session('success') }}
                        </div>
                    </div>
                    @endif

                    <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Title')" required/>
                            <x-input id="title" class="block mt-1 w-full" type="text" name="title"
                                :value="old('title')" required autofocus/>
                            @error('title')
                            <span class="text-red-600 text-sm" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <x-input-label for="section" :value="__('Section')" required/>
                            <x-select id="section" name="section" required>
                                <option value="" disabled selected>{{ __('Select Section') }}</option>
                                <option value="before-slider" {{ old('section') == 'before-slider' ? 'selected' : '' }}>{{ __('Before Slider') }}</option>
                                <option value="slider" {{ old('section') == 'slider' ? 'selected' : '' }}>{{ __('Slider') }}</option>
                                <option value="after-slider" {{ old('section') == 'after-slider' ? 'selected' : '' }}>{{ __('After Slider') }}</option>
                                <option value="before-featured" {{ old('section') == 'before-featured' ? 'selected' : '' }}>{{ __('Before Featured') }}</option>
                                <option value="featured" {{ old('section') == 'featured' ? 'selected' : '' }}>{{ __('Featured') }}</option>
                                <option value="after-featured" {{ old('section') == 'after-featured' ? 'selected' : '' }}>{{ __('After Featured') }}</option>
                                <option value="before-new-arrival" {{ old('section') == 'before-new-arrival' ? 'selected' : '' }}>{{ __('Before New Arrival') }}</option>
                                <option value="after-new-arrival" {{ old('section') == 'after-new-arrival' ? 'selected' : '' }}>{{ __('After New Arrival') }}</option>
                                <option value="banner" {{ old('section') == 'banner' ? 'selected' : '' }}>{{ __('Banner') }}</option>
                                <option value="footer" {{ old('section') == 'footer' ? 'selected' : '' }}>{{ __('Footer') }}</option>
                                <option value="sidebar" {{ old('section') == 'sidebar' ? 'selected' : '' }}>{{ __('Sidebar') }}</option>
                            </x-select>
                            @error('section')
                            <span class="text-red-600 text-sm" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <x-input-label for="image" :value="__('Banner image')" required/>
                            <p class="text-xs text-gray-600">Recommended image size is 1920x1080 pixels & file size is less than 2MB.</p>
                            <input type="file" id="image" name="image" accept="image/*" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" onchange="previewImage(event)" />
                            @error('image')
                            <span class="text-red-600 text-sm" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Image Preview and Size Display -->
                        <div id="image-preview-container" class="mb-4 hidden">
                            <div class="relative flex items-center space-x-4">
                                <!-- Thumbnail Image Preview -->
                                <img id="image-preview" src="" alt="Image Preview" class="w-40 h-auto rounded-md border border-gray-300">

                                <!-- Remove Button -->
                                <button type="button" class="absolute top-0 right-0 bg-red-600 text-white rounded-full p-2 focus:outline-none" onclick="removeImage()">
                                    &times;
                                </button>
                            </div>
                            <!-- Highlighted Image Size -->
                            <p id="image-size" class="text-sm font-semibold text-gray-700 mt-2 bg-yellow-100 p-2 rounded-md"></p>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="link" :value="__('Link')"/>
                            <x-input id="link" class="block mt-1 w-full" type="url" name="link"
                                placeholder="https://binbox.com.bd/collection/natural-products"
                                :value="old('link')"/>
                            @error('link')
                            <span class="text-red-600 text-sm" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <x-input-label for="order_column" :value="__('Order')"/>
                            <x-input id="order_column" class="block mt-1 w-full" type="number" name="order_column"
                                :value="old('order_column', 0)" required/>
                            @error('order_column')
                            <span class="text-red-600 text-sm" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="is_active" class="flex items-center">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" id="is_active" name="is_active" value="1" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" {{ old('is_active') ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-700">{{ __('Active') }}</span>
                            </label>
                            @error('is_active')
                            <span class="text-red-600 text-sm" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="flex items center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 mr-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">
                                {{ __('Create Banner') }}
                            </button>
                            <a href="{{ route('banners.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-200 disabled:opacity-25 transition">
                                {{ __('Back') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            var input = event.target;
            var previewContainer = document.getElementById('image-preview-container');
            var previewImage = document.getElementById('image-preview');
            var imageSizeText = document.getElementById('image-size');

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');  // Show preview container
                };
                reader.readAsDataURL(input.files[0]);

                // Display image size in KB or MB
                var fileSizeInBytes = input.files[0].size;
                var fileSizeInKB = (fileSizeInBytes / 1024).toFixed(2);
                var fileSizeInMB = (fileSizeInBytes / (1024 * 1024)).toFixed(2);
                if (fileSizeInMB > 1) {
                    imageSizeText.innerHTML = `<strong>Size:</strong> ${fileSizeInMB} MB`;
                } else {
                    imageSizeText.innerHTML = `<strong>Size:</strong> ${fileSizeInKB} KB`;
                }

                // Add highlight class to image size text
                imageSizeText.classList.add('bg-yellow-100', 'p-2', 'rounded-md');
            }
        }

        function removeImage() {
            var input = document.getElementById('image');
            var previewContainer = document.getElementById('image-preview-container');
            var previewImage = document.getElementById('image-preview');
            var imageSizeText = document.getElementById('image-size');

            input.value = '';  // Clear the input value
            previewImage.src = '';  // Remove image preview
            imageSizeText.textContent = '';  // Remove file size text
            previewContainer.classList.add('hidden');  // Hide preview container
        }

         // on section change show additional info for image
        document.getElementById('section').addEventListener('change', function() {
            var section = this.value;
            var additionalInfo = document.querySelector('.image-additional-info');

            if (section === 'slider') {
                additionalInfo.textContent = 'Recommended image size: 1920 x 1080 pixels';
            } else if (section === 'featured') {
                additionalInfo.textContent = 'Recommended image size: 400 x 400 pixels';
            } else if (section === 'banner') {
                additionalInfo.textContent = 'Recommended image size: 1200 x 400 pixels';
            } else if (section === 'footer') {
                additionalInfo.textContent = 'Recommended image size: 1200 x 400 pixels';
            } else if (section === 'sidebar') {
                additionalInfo.textContent = 'Recommended image size: 300 x 300 pixels';
            } else {
                additionalInfo.textContent = '';
            }
        });
    </script>

</x-app-layout>
