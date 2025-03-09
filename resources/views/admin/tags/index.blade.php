<x-app-layout>
    
    <x-slot name="title">
        {{ $pageTitle ?? config('app.name', 'Laravel') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex justify-between items-center">
            <a href="{{ route('tags.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">
                {{ __('Create Tag') }}
            </a>
            
            <div class="flex space-x-4">
                <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition">
                    {{ __('Products') }}
                </a>
                <a href="{{ route('categories.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition">
                    {{ __('Categories') }}
                </a>
                <a href="{{ route('vendors.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition">
                    {{ __('Brand') }}
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
                        <form method="GET" action="{{ route('tags.index') }}">
                            <x-text-input type="text" name="search" value="{{ $search }}" placeholder="Search..." class="w-full" />
                        </form>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($tags as $tag)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $tag->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $tag->slug }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('tags.edit', $tag->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                        <span class="mx-2">|</span>
                                        <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" class="inline-block" onsubmit="return confirmDelete(event, '{{ $tag->name }}');">
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
                        {{ $tags->links() }} <!-- This will render the pagination controls -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(event, tagName) {
            event.preventDefault();
            if (confirm('Are you sure you want to delete the tag "' + tagName + '"?')) {
                const form = event.target;
                form.submit();
            }
        }
    </script>
</x-app-layout>
