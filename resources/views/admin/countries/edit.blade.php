<x-app-layout>

    <x-slot name="title">
        {{ $pageTitle ?? config('app.name', 'Laravel') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Countries') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- show error --}}
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">There're some errors with your submission</span>
                    <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{-- show success --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('countries.update', $country->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- capital -->
                        <div>
                            <x-input-label for="capital" :value="__('Capital')" required />
                            <x-text-input id="capital" type="text" name="capital" value="{{ $country->capital }}" class="block mt-1 w-full" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('capital')" />
                        </div>

                        {{-- citizenship --}}
                        <div class="mt-4">
                            <x-input-label for="citizenship" :value="__('Citizenship')" required />
                            <x-text-input id="citizenship" type="text" name="citizenship" value="{{ $country->citizenship }}" class="block mt-1 w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('citizenship')" />
                        </div>

                        {{-- country_code --}}
                        <div class="mt-4">
                            <x-input-label for="country_code" :value="__('Country Code')" required />
                            <x-text-input id="country_code" type="text" name="country_code" value="{{ $country->country_code }}" class="block mt-1 w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('country_code')" />
                        </div>
                            
                        {{-- currency --}}
                        <div class="mt-4">
                            <x-input-label for="currency" :value="__('Currency')" required />
                            <x-text-input id="currency" type="text" name="currency" value="{{ $country->currency }}" class="block mt-1 w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('currency')" />
                        </div>

                        {{-- currency_code --}}
                        <div class="mt-4">
                            <x-input-label for="currency_code" :value="__('Currency Code')" required />
                            <x-text-input id="currency_code" type="text" name="currency_code" value="{{ $country->currency_code }}" class="block mt-1 w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('currency_code')" />
                        </div>

                        {{-- currency_sub_unit --}}
                        <div class="mt-4">
                            <x-input-label for="currency_sub_unit" :value="__('Currency Sub Unit')" required/>
                            <x-text-input id="currency_sub_unit" type="text" name="currency_sub_unit" value="{{ $country->currency_sub_unit }}" class="block mt-1 w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('currency_sub_unit')" />
                        </div>

                        {{-- currency_symbol --}}
                        <div class="mt-4">
                            <x-input-label for="currency_symbol" :value="__('Currency Symbol')" required />
                            <x-text-input id="currency_symbol" type="text" name="currency_symbol" value="{{ $country->currency_symbol }}" class="block mt-1 w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('currency_symbol')" />
                        </div>

                        {{-- full_name --}}
                        <div class="mt-4">
                            <x-input-label for="full_name" :value="__('Full Name')" required />
                            <x-text-input id="full_name" type="text" name="full_name" value="{{ $country->full_name }}" class="block mt-1 w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('full_name')" />
                        </div>

                        {{-- iso_3166_2 --}}
                        <div class="mt-4">
                            <x-input-label for="iso_3166_2" :value="__('ISO 3166 2')" required />
                            <x-text-input id="iso_3166_2" type="text" name="iso_3166_2" value="{{ $country->iso_3166_2 }}" class="block mt-1 w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('iso_3166_2')" />
                        </div>

                        {{-- iso_3166_3 --}}
                        <div class="mt-4">
                            <x-input-label for="iso_3166_3" :value="__('ISO 3166 3')" required />
                            <x-text-input id="iso_3166_3" type="text" name="iso_3166_3" value="{{ $country->iso_3166_3 }}" class="block mt-1 w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('iso_3166_3')" />
                        </div>

                        {{-- name --}}
                        <div class="mt-4">
                            <x-input-label for="name" :value="__('Name')" required />
                            <x-text-input id="name" type="text" name="name" value="{{ $country->name }}" class="block mt-1 w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        {{-- region_code --}}
                        <div class="mt-4">
                            <x-input-label for="region_code" :value="__('Region Code')" required />
                            <x-text-input id="region_code" type="text" name="region_code" value="{{ $country->region_code }}" class="block mt-1 w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('region_code')" />
                        </div>

                        {{-- sub_region_code --}}
                        <div class="mt-4">
                            <x-input-label for="sub_region_code" :value="__('Sub Region Code')" required />
                            <x-text-input id="sub_region_code" type="text" name="sub_region_code" value="{{ $country->sub_region_code }}" class="block mt-1 w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('sub_region_code')" />
                        </div>

                        {{-- eea --}}
                        <div class="mt-4">
                            <x-input-label for="eea" :value="__('EEA')" required />
                            <x-text-input id="eea" type="text" name="eea" value="{{ $country->eea }}" class="block mt-1 w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('eea')" />
                        </div>

                        {{-- calling_code --}}
                        <div class="mt-4">
                            <x-input-label for="calling_code" :value="__('Calling Code')" required />
                            <x-text-input id="calling_code" type="text" name="calling_code" value="{{ $country->calling_code }}" class="block mt-1 w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('calling_code')" />
                        </div>

                        {{-- status --}}
                        <div class="mt-4">
                            <x-input-label for="status" :value="__('Status')" required />
                            <x-select id="status" name="status" required>
                                <option value="active" {{ $country->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $country->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div>

                        <div class="mt-4 flex justify-between items-center">
                            <x-primary-button>{{ __('Update Country') }}</x-primary-button>
                        
                            <div class="flex items-center space-x-4">
                                <a href="{{ route('countries.index') }}" class="text-blue-600 hover:underline">{{ __('Back to countries') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

