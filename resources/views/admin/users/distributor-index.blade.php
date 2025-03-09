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
                <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition">
                    {{ __('Users') }}
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

                    <!-- Pagination Controls -->
                    <div class="mt-4 mb-4">
                        {{ $distributors->links() }} <!-- This will render the pagination controls -->
                    </div>

                    <!-- User Display -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submit Time</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Times</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 text-sm">
                                @foreach($distributors as $distributor)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $distributor->created_at->format('Y-m-d H:i:s') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $distributor->first_name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $distributor->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $distributor->phone }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $distributor->company_name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if(!empty($distributor->best_time))
                                                @foreach($distributor->best_time as $time)
                                                    <span class="inline-block bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">
                                                        {{ $time }}
                                                    </span>
                                                @endforeach
                                            @else
                                                <span class="text-gray-500">N/A</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    <!-- Pagination Controls -->
                    <div class="mt-4">
                        {{ $distributors->links() }} <!-- This will render the pagination controls -->
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
