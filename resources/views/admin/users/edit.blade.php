<x-app-layout>

    <x-slot name="title">
        {{ $pageTitle ?? config('app.name', 'Laravel') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User: ' . $user->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form enctype="multipart/form-data" action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <x-input-label for="Name" :value="__('Name')" />
                            <x-text-input 
                                type="text" 
                                id="name" 
                                name="name" 
                                value="{{ old('name') ?? $user->name }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                                required />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="Email" :value="__('Email')" />
                            <x-text-input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') ?? $user->email }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                                autocomplete="off" 
                                required />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="Password" :value="__('Password')" />
                            <x-text-input 
                                type="password" 
                                id="password"
                                name="password" 
                                autocomplete="off"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                            <x-input-error class="mt-2" :messages="$errors->get('password')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="Confirm Password" :value="__('Confirm Password')" />
                            <x-text-input 
                                type="password" 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                            <x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />
                        </div>

                        <div class="mb-4">
                            <label for="is_admin" class="block text-sm font-medium text-gray-700">Is Admin</label>
                            <select 
                                id="is_admin" 
                                name="is_admin" 
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                <option value="0" {{ $user->is_admin === 0 ? 'selected' : '' }}>No</option>
                                <option value="1" {{ $user->is_admin === 1 ? 'selected' : '' }}>Yes</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('is_admin')" />
                        </div>

                        {{-- status --}}
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select 
                                id="status" 
                                name="status" 
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                <option value="pending" {{ $user->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="active" {{ $user->status === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $user->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="banned" {{ $user->status === 'banned' ? 'selected' : '' }}>Banned</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div>


                        <div class="flex items center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Update User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>