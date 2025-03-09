<x-app-layout>

    <x-slot name="title">
        {{ $pageTitle ?? config('app.name', 'Laravel') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('banners.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">
                {{ __('Create Banner') }}
            </a>
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
                            // Hide the toast message after 3 seconds
                            setTimeout(() => {
                                const toast = document.getElementById('toast');
                                toast.style.display = 'none';
                            }, 3000);
                        </script>
                    @endif

                    <div class="mb-4">
                        <x-input id="search" placeholder="Search..." class="w-full" />
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200" id="banners-table">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Image</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Link</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">Section</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">Order</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Active</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 text-sm">
                                @foreach($banners as $banner)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $banner->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap hidden sm:table-cell">
                                            @if($banner->image)
                                                <img 
                                                data-src="{{ asset('storage/' . $banner->image) }}"
                                                {{-- src="{{ asset('storage/' . $banner->image) }}"  --}}
                                                alt="{{ $banner->title }}" 
                                                class="w-16 h-16 object-cover rounded cursor-pointer lozad"
                                                onclick="openModal('{{ asset('storage/' . $banner->image) }}')">
                                            @else
                                                <span class="text-gray-500">{{ __('No Image') }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap hidden md:table-cell">{{ $banner->link }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap hidden lg:table-cell">{{ ucfirst($banner->section) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap hidden lg:table-cell">{{ $banner->order_column }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap hidden sm:table-cell">
                                            <span class="inline-flex items-center px-2 py-1 text-xs font-semibold leading-5 {{ $banner->is_active ? 'text-green-800 bg-green-100' : 'text-red-800 bg-red-100' }} rounded-full">
                                                {{ $banner->is_active ? __('Yes') : __('No') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('banners.edit', $banner->id) }}" class="text-blue-600 hover:underline">{{ __('Edit') }}</a>
                                            <span class="text-gray-400">|</span>
                                            <form action="{{ route('banners.destroy', $banner->id) }}" method="POST" class="inline-block" onsubmit="return confirmDelete(event, '{{ $banner->title }}');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">{{ __('Delete') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>                   

                    <!-- Pagination Controls -->
                    <div class="mt-4">
                        {{ $banners->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Image Preview -->
    <div id="imageModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 justify-center items-center">
        <div class="relative bg-white rounded-lg max-w-lg">
            <span class="absolute top-2 right-2 cursor-pointer text-black text-2xl" onclick="closeModal()">&times;</span>
            <img id="modalImage" class="w-full h-auto">
        </div>
    </div>

    <script>
        function openModal(imageUrl) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            modalImage.src = imageUrl;
            modal.classList.remove('hidden');
        }

        function closeModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
        }

        function confirmDelete(event, bannerTitle) {
            event.preventDefault();
            if (confirm('Are you sure you want to delete this banner?')) {
                const form = event.target;
                form.submit();
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('search');
            const tableRows = document.querySelectorAll('#banners-table tbody tr');

            searchInput.addEventListener('input', () => {
                const searchTerm = searchInput.value.toLowerCase();
                tableRows.forEach(row => {
                    const cells = row.querySelectorAll('td');
                    const rowContainsSearchTerm = Array.from(cells).some(cell => 
                        cell.textContent.toLowerCase().includes(searchTerm)
                    );
                    row.style.display = rowContainsSearchTerm ? '' : 'none';
                });
            });
        });
    </script>
</x-app-layout>