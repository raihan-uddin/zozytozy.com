<x-app-layout>

    <x-slot name="title">
        {{ $pageTitle ?? config('app.name', 'Laravel') }}
    </x-slot>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex justify-between items-center">
            <a href="#" class="disabled inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">
                {{ __('Create Country') }}
            </a>
            <!-- Right side: Settings and States links -->
            <div class="flex space-x-4">
                <a href="{{ route('settings.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition">
                    {{ __('Settings') }}
                </a>
                <a href="{{ route('states.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition">
                    {{ __('States') }}
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
                    <div class="mt-4 mb-4">
                        {{ $countries->links() }} <!-- This will render the pagination controls -->
                    </div>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">#</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                                <th class="px-6 py-3 bg-gray-50"></th>
                                <th class="px-6 py-3 bg-gray-50">
                                    <input type="checkbox" id="select-all" class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out">
                                </th>
                                <th class="px-6 py-3 bg-gray-50"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($countries as $country)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $country->id }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $country->name }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $country->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $country->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        {{ $country->created_at->diffForHumans() }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                        <div>
                                            <img src="{{ asset('images/flags/' . $country->flag) }}" alt="{{ $country->name }}" class="w-8 h-8 object-cover rounded-full">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" name="selected_countries[]" value="{{ $country->id }}" class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out">
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                        <a href="{{ route('countries.edit', $country->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination Controls -->
                    <div class="mt-4 mb-4">
                        {{ $countries->links() }} <!-- This will render the pagination controls -->

                        <div class="flex space x-4 mt-4 gap-2">
                            <button onclick="changeStatus('active')" class="bg-green-600 text-white px-4 py-2 rounded-md w-full">{{ __('Activate') }}</button>
                            <button onclick="changeStatus('inactive')" class="bg-red-600 text-white px-4 py-2 rounded-md w-full">{{ __('Deactivate') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const selectAll = document.getElementById('select-all');
        const checkboxes = document.querySelectorAll('input[name="selected_countries[]"]');

        selectAll.addEventListener('click', function() {
            checkboxes.forEach((checkbox) => {
                checkbox.checked = selectAll.checked;
            });
        });

        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('click', function() {
                if (!this.checked) {
                    selectAll.checked = false;
                }
            });
        });

        // change the status of selected countries active or inactive using AJAX

        const changeStatus = (status) => {
            const selectedCountries = Array.from(document.querySelectorAll('input[name="selected_countries[]"]:checked')).map(checkbox => checkbox.value);
            if (selectedCountries.length === 0) {
                alert('Please select at least one country');
                return;
            }

            const confirmation = confirm(`Are you sure you want to change the status of ${selectedCountries.length} countries to ${status}?`);
            if (confirmation) {
                fetch('{{ route('countries.change-status') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        countries: selectedCountries,
                        status: status
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.status == 'success') {
                        window.location.reload();
                    } else {
                        alert('Something went wrong');
                    }
                });
            }
        }
    </script>

</x-app-layout>
