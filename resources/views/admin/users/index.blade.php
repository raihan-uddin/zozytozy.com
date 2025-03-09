<x-app-layout>
    <x-slot name="title">
        {{ $pageTitle ?? config('app.name', 'Laravel') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex justify-between items-center">
            <a href="{{ route('users.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">
                {{ __('Create User') }}
            </a>

            <!-- Right side: Distributor -->
            <div class="flex space-x-4">
                <a href="{{ route('distributors.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition">
                    {{ __('Wholesaler') }}
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
                        <form method="GET" action="{{ route('users.index') }}">
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-4">
                                <!-- Search by name -->
                                <x-text-input id="name"  type="text" name="filter[name]"  placeholder="Search by name" value="{{ $filter['name'] ?? '' }}" />
                                {{-- Filter by is_admin --}}
                                <x-select name="filter[is_admin]">
                                    <option value="">{{ __('Filter by is_admin') }}</option>
                                    <option value="1" {{ ($filter['is_admin'] ?? '') == '1' ? 'selected' : '' }}>{{ __('Yes') }}</option>
                                    <option value="0" {{ ($filter['is_admin'] ?? '') == '0' ? 'selected' : '' }}>{{ __('No') }}</option>
                                </x-select>
                                <!-- Filter by status -->
                                <x-select name="filter[status]">
                                    <option value="">{{ __('Filter by status') }}</option>
                                    <option value="active" {{ ($filter['status'] ?? '') == 'active' ? 'selected' : '' }}>{{ __('Active') }}</option>
                                    <option value="inactive" {{ ($filter['status'] ?? '') == 'inactive' ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                                    <option value="pending" {{ ($filter['status'] ?? '') == 'pending' ? 'selected' : '' }}>{{ __('Pending') }}</option>
                                    <option value="deleted" {{ ($filter['status'] ?? '') == 'deleted' ? 'selected' : '' }}>{{ __('Deleted') }}</option>                                    
                                </x-select>
                                <!-- Filter by category -->

                                <!-- Filter and Reset buttons -->
                                <div class="flex space-x-2">
                                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md w-full">{{ __('Filter') }}</button>
                                    <a href="{{ route('users.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md w-full text-center">{{ __('Reset') }}</a>
                                </div>
                            </div>

                            <!-- Sorting section -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-4">
                                <!-- Sort by field -->
                                <x-select name="sort_by">
                                    <option value="">{{ __('Sort by') }}</option>
                                    <option value="name" {{ ($filter['sort_by'] ?? '') == 'name' ? 'selected' : '' }}>{{ __('Name') }}</option>
                                    <option value="email" {{ ($filter['sort_by'] ?? '') == 'email' ? 'selected' : '' }}>{{ __('Email') }}</option>
                                    <option value="status" {{ ($filter['sort_by'] ?? '') == 'status' ? 'selected' : '' }}>{{ __('Status') }}</option>
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
                        {{ $users->links() }} <!-- This will render the pagination controls -->
                    </div>

                    <!-- User Display -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Admin</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Verified At</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 text-sm">
                                @foreach($users as $user)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->is_admin ? 'Yes' : 'No' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->email_verified_at ? $user->email_verified_at->diffForHumans() : 'Not Verified' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->status == 'active' ? 'bg-green-100 text-green-800' : ($user->status == 'inactive' ? 'bg-yellow-100 text-yellow-800' : ($user->status == 'pending' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800')) }}">
                                                {{ ucfirst($user->status) }}
                                            </span>

                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('users.edit', $user->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                            <span class="mx-2">|</span>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirmDelete(event, '{{ $user->name }}');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    <!-- Pagination Controls -->
                    <div class="mt-4">
                        {{ $users->links() }} <!-- This will render the pagination controls -->
                    </div>
                    
                </div>
            </div>
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
