<x-app-layout>

    <x-slot name="title">
        {{ $pageTitle ?? config('app.name', 'Laravel') }}
    </x-slot>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex justify-between items-center">
            <a href="{{ route('states.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">
                {{ __('Create State') }}
            </a>
            <!-- Right side: Settings and States links -->
            <div class="flex space-x-4">
                <a href="{{ route('settings.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition">
                    {{ __('Settings') }}
                </a>
                <a href="{{ route('countries.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition">
                    {{ __('Countries') }}
                </a>
                <a href="{{ route('phpinfo') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition">
                    {{ __('PHP Info') }}
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
                    {{-- <div class="mt-4 mb-4">
                        {{ $states->links() }} <!-- This will render the pagination controls -->
                    </div> --}}

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">#</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">State</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Tax Rate</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Delivery Fee</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Updated At</th>
                                <th class="px-6 py-3 bg-gray-50"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($states as $state)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $state->id }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $state->state }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-center">{{ $state->tax_rate }}%</td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-center">{{ $state->delivery_fee }}$</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $state->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $state->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        {{ $state->updated_at->diffForHumans() }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                        <a href="{{ route('states.edit', $state->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination Controls -->
                    {{-- <div class="mt-4 mb-4">
                        {{ $states->links() }} <!-- This will render the pagination controls -->
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
