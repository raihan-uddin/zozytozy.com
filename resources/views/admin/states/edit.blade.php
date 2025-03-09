<x-app-layout>

    <x-slot name="title">
        {{ $pageTitle ?? config('app.name', 'Laravel') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit States') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- show errors --}}
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">There are some errors with your submission</span>
                    <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('states.update', $state->id) }}">
                        @csrf
                        @method('PUT')
                        {{-- country_id --}}
                        <div>
                            <x-input-label for="country_id" :value="__('Country')" required />
                            <x-select id="country_id" name="country_id" required>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ $state->country_id == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('country_id')" />
                        </div>

                        <!-- state -->
                        <div>
                            <x-input-label for="state" :value="__('State')" required />
                            <x-text-input id="state" type="text" name="state" value="{{ $state->state }}" class="block mt-1 w-full" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('state')" />
                        </div>

                        {{-- tax_rate --}}
                        <div class="mt-4">
                            <x-input-label for="tax_rate" :value="__('Tax Rate')" required />
                            <x-text-input id="tax_rate" type="text" name="tax_rate" value="{{ $state->tax_rate }}" class="block mt-1 w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('tax_rate')" />
                        </div>

                        {{-- delivery_fee --}}
                        <div class="mt-4">
                            <x-input-label for="delivery_fee" :value="__('Delivery Fee')" required />
                            <x-text-input id="delivery_fee" type="text" name="delivery_fee" value="{{ $state->delivery_fee }}" class="block mt-1 w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('delivery_fee')" />
                        </div>

                        

                        {{-- status --}}
                        <div class="mt-4">
                            <x-input-label for="status" :value="__('Status')" required />
                            <x-select id="status" name="status" required>
                                <option value="active" {{ $state->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $state->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div>


                        <div class="mt-4 flex justify-between items-center">
                            <x-primary-button>{{ __('Update state') }}</x-primary-button>
                        
                            <div class="flex items-center space-x-4">
                                <a href="{{ route('states.index') }}" class="text-blue-600 hover:underline">{{ __('Back to states') }}</a>
                            </div>
                        </div>
                        
            
                    </form>
                </div>
            </div>            
        </div>
    </div>
</x-app-layout>

