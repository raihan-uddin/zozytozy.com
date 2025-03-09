<x-app-layout>

    <x-slot name="title">
        {{ $pageTitle ?? config('app.name', 'Laravel') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('coupons.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">
                {{ __('Create Coupons') }}
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

                    <table class="min-w-full divide-y divide-gray-200" id="coupons-table">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Value</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Min Order Value</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Range</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-sm">
                            @foreach($coupons as $coupon)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $coupon->code }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($coupon->type) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $coupon->type === 'fixed' ? $coupon->value . "$" : $coupon->value . "%" }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $coupon->min_order_value == 0 ? 'No Minimum' : $coupon->min_order_value . "$" }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $coupon->start_date->format('M d, Y') }} - {{ $coupon->end_date->format('M d, Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2 py-1 text-xs font-semibold leading-5 {{ $coupon->active ? 'text-green-800 bg-green-100' : 'text-red-800 bg-red-100' }} rounded-full">
                                            {{ $coupon->active ? __('Yes') : __('No') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('coupons.edit', $coupon->id) }}" class="text-blue-600 hover:underline">{{ __('Edit') }}</a>
                                        <span class="text-gray-400">|</span>
                                        <form action="{{ route('coupons.destroy', $coupon->id) }}" method="POST" class="inline-block" onsubmit="return confirmDelete(event, '{{ $coupon->code }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">{{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination Controls -->
                    <div class="mt-4">
                        {{ $coupons->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(event, couponTitle) {
            event.preventDefault();
            if (confirm('Are you sure you want to delete the coupon: ' + couponTitle + '?')) {
                const form = event.target;
                form.submit();
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('search');
            const tableRows = document.querySelectorAll('#coupons-table tbody tr');

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