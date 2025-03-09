<x-app-layout>

    <x-slot name="title">
        {{ $pageTitle ?? config('app.name', 'Laravel') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Coupon') }}
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
                            <span class="ml-3 font-medium text-green-800">{{ __('Coupon created successfully!') }}</span>
                        </div>
                        <div class="mt-2 text-sm text-green-700">
                            {{ session('success') }}
                        </div>
                    </div>
                    @endif

                    <form action="{{ route('coupons.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- code --}}
                        <div class="mb-4">
                            <x-input-label for="code" :value="__('Code')" required />
                            <x-input id="code" class="block mt-1 w-full" type="text" name="code"
                                :value="old('code')" required autofocus/>
                            @error('code')
                            <span class="text-red-600 text-sm" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="flex flex-wrap -mx-2">
                            {{-- type --}}
                            <div class="w-full sm:w-1/2 px-2 mb-4">
                                <x-input-label for="type" :value="__('Type')" required />
                                <x-select id="type" name="type" required>
                                    <option value="percent" {{ old('type') === 'percent' ? 'selected' : '' }}>Percent</option>
                                    <option value="fixed" {{ old('type') === 'fixed' ? 'selected' : '' }}>Fixed</option>
                                </x-select>
                                @error('type')
                                <span class="text-red-600 text-sm" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        
                            {{-- value --}}
                            <div class="w-full sm:w-1/2 px-2 mb-4">
                                <x-input-label for="value" :value="__('Value')" required />
                                <x-input id="value" class="block mt-1 w-full" type="number" name="value" :value="old('value')" required />
                                @error('value')
                                <span class="text-red-600 text-sm" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>                        
                        
                        {{-- min_order_value --}}
                        <div class="mb-4">
                            <x-input-label for="min_order_value" :value="__('Min Order Value')" required/>
                            <x-input id="min_order_value" class="block mt-1 w-full" type="number" name="min_order_value"
                                :value="old('min_order_value', 0)" required/>
                            @error('min_order_value')
                            <span class="text-red-600 text-sm" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="flex flex-wrap -mx-2">
                            {{-- start_date --}}
                            <div class="w-full sm:w-1/2 px-2 mb-4">
                                <x-input-label for="start_date" :value="__('Start Date')" required />
                                <x-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" :value="old('start_date')" required />
                                @error('start_date')
                                <span class="text-red-600 text-sm" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        
                            {{-- end_date --}}
                            <div class="w-full sm:w-1/2 px-2 mb-4">
                                <x-input-label for="end_date" :value="__('End Date')" required />
                                <x-input id="end_date" class="block mt-1 w-full" type="date" name="end_date" :value="old('end_date')" required />
                                @error('end_date')
                                <span class="text-red-600 text-sm" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>                        

                        {{-- active --}}
                        <div class="mb-4">
                            <x-input-label for="active" :value="__('Active')" required />
                            <x-select id="active" name="active" required >
                                <option value="1" {{ old('active') === '1' ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ old('active') === '0' ? 'selected' : '' }}>No</option>
                            </x-select>
                            @error('active')
                            <span class="text-red-600 text-sm" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- description --}}
                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <x-textarea id="description" class="block mt-1 w-full" name="description">{{ old('description') }}</x-textarea>
                            @error('description')
                            <span class="text-red-600 text-sm" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="flex items center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 mr-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">
                                {{ __('Create Coupon') }}
                            </button>
                            <a href="{{ route('coupons.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-200 disabled:opacity-25 transition">
                                {{ __('Back') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
