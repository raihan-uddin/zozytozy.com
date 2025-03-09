<x-app-layout>

    <x-slot name="title">
        {{ $pageTitle ?? config('app.name', 'Laravel') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New User/Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form id="create-user-form" enctype="multipart/form-data" x-data="userForm()" @submit.prevent="submitForm">
                        @csrf
                        <div class="mb-4">
                            <x-input-label for="Name" :value="__('Name')" required/>
                            <x-input id="name" x-model="name" class="block mt-1 w-full" type="text" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="Email" :value="__('Email')" required/>
                            <x-input id="email" x-model="email" class="block mt-1 w-full" type="email" required />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="Password" :value="__('Password')" required/>
                            <x-input id="password" x-model="password" class="block mt-1 w-full" type="password" required />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="Confirm Password" :value="__('Confirm Password')" required/>
                            <x-input id="password_confirmation" x-model="password_confirmation" class="block mt-1 w-full" type="password" required />
                        </div>


                        {{-- is_admin --}}
                        <div class="mb-4">
                            <label for="is_admin" class="block text-sm font-medium text-gray-700">Is Admin</label>
                            <select id="is_admin" name="is_admin" x-model="is_admin" class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                        
                        {{-- submit --}}
                        <div class="flex items center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Create User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function userForm() {
            return {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                is_admin: 0,
                submitForm() {
                    let form = document.getElementById('create-user-form');
                    let formData = new FormData(form);
                    axios.post('{{ route('users.store') }}', formData)
                        .then(response => {
                            window.location.href = response.data.redirect;
                        })
                        .catch(error => {
                            console.log(error.response.data);
                        });
                }
            }
        }
    </script>

</x-app-layout>

