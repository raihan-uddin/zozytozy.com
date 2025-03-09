<x-app-layout>

    <x-slot name="title">
        {{ $pageTitle ?? config('app.name', 'Laravel') }}
    </x-slot>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex justify-between items-center">
            <a href="{{ route('vendors.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">
                {{ __('Create Brand') }}
            </a>
            
            <div class="flex space-x-4">
                <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition">
                    {{ __('Products') }}
                </a>
                <a href="{{ route('categories.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition">
                    {{ __('Categories') }}
                </a>
                <a href="{{ route('tags.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition">
                    {{ __('Tags') }}
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

                    <div class="mb-4">
                        <form method="GET" action="{{ route('vendors.index') }}">
                            <x-input type="text" name="search" value="{{ $search }}" placeholder="Search..." class="border rounded px-3 py-2 w-full"></x-input>
                            {{-- <button type="submit" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded">Search</button> --}}
                        </form>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200" id="vendors-table">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Logo</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($vendors as $vendor)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $vendor->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $vendor->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $vendor->phone }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $vendor->address }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($vendor->logo_src)
                                            <img src="{{ asset('storage/' . $vendor->logo_src) }}" alt="{{ $vendor->name }}" class="w-10 h-10 object-cover rounded-full">
                                        @else
                                            <span class="text-red-500">No Logo</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($vendor->status == 'active')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Active
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('vendors.edit', $vendor->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                        {{-- <span class="text-gray-400">|</span>
                                        <form action="{{ route('vendors.destroy', $vendor->id) }}" method="POST" class="inline-block" onsubmit="return confirmDelete(event, '{{ $vendor->name }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                        </form> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination Controls -->
                    <div class="mt-4">
                        {{ $vendors->links() }} <!-- This will render the pagination controls -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(event, vendorName) {
            event.preventDefault();
            if (confirm('Are you sure you want to delete the Brand "' + vendorName + '"?')) {
                const form = event.target;
                form.submit();
            }
        }
    </script>
</x-app-layout>
