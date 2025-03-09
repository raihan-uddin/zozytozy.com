<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('E-commerce Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Advanced Analytics Cards with Dummy Data -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <!-- Total Revenue -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-gray-500">Total Revenue</h3>
                    <p class="text-3xl font-bold">${{ number_format($currentWeekRevenue, 2) }}</p>
                    <span class="text-green-500">{{ $revenueChange }}</span>
                </div>
                
                <!-- Orders Overview -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-gray-500">Total Orders</h3>
                    <p class="text-3xl font-bold">{{ $totalOrders }}</p>
                    <span class="text-green-500">{{ $ordersChange }}</span>
                </div>
                
                <!-- Top-Selling Product -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-gray-500">Top-Selling Product</h3>
                    <p class="text-xl">{{ $topSellingProduct }}</p>
                    <span class="text-gray-500">Sold: {{ $unitsSold }} units</span>
                </div>
                
                <!-- New Customers -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-gray-500">New Customers</h3>
                    <p class="text-3xl font-bold">{{ $currentWeekNewCustomers }}</p>
                    <span class="text-green-500">{{ $customersChange }}</span>
                </div>
            </div>


            <!-- Sales and Customer Behavior Charts (Dummy Data) -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Sales Trend Chart -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-gray-500 mb-4">Sales Trend (Last 7 Days)</h3>
                    <div id="salesChart" class="h-80 w-full"></div> <!-- Adjusted to full width and set height -->
                </div>
            
                <!-- Customer Retention Chart -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-gray-500 mb-4">Customer Retention Rate</h3>
                    <div id="customerRetentionChart" class="h-80 w-full"></div> <!-- Adjusted to full width and set height -->
                </div>
            </div>           

            <!-- Recent Orders with Status Colors -->
            <div x-data="recentOrders()" x-init="loadRecentOrders" class="bg-white shadow-md rounded-lg p-6 mb-6">
                <h3 class="text-gray-500 mb-4">Recent Orders</h3>
                
                <template x-if="loading">
                    <div class="text-gray-500">Loading...</div>
                </template>
                
                <template x-if="error">
                    <div class="text-red-500" x-text="error"></div>
                </template>
            
                <template x-if="!loading && !error">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Order ID</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Customer</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Amount</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="order in orders" :key="order.id">
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm" x-text="order.id"></td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm" x-text="order.customer_name"></td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm" x-text="new Date(order.created_at).toLocaleDateString()"></td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm" x-text="`$${order.total}`"></td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                        <span :class="{'text-green-500': order.status === 'completed', 'text-yellow-500': order.status === 'pending'}" x-text="order.status.charAt(0).toUpperCase() + order.status.slice(1)"></span>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                        <button class="bg-blue-500 text-white px-3 py-1 rounded">View</button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </template>
            </div>
            

            <!-- Stock Alerts with Low Inventory -->
            <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                <h3 class="text-gray-500 mb-4">Low Stock Products</h3>
                <ul>
                    <li class="mb-2">Vitamin C Moisturizer - <span class="text-red-500">4 units left</span></li>
                    <li class="mb-2">Rose Water Toner - <span class="text-red-500">2 units left</span></li>
                    <li>Green Tea Cleanser - <span class="text-red-500">7 units left</span></li>
                </ul>
            </div>
        </div>
    </div>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Sales chart configuration
            Highcharts.chart('salesChart', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'Sales Over Time'
                },
                xAxis: {
                    categories: @json(array_reverse(array_map(function ($date) {
                        return \Carbon\Carbon::parse($date)->format('M j');
                    }, array_keys($salesChartData)))),
                },
                yAxis: {
                    title: {
                        text: 'Sales (in $)'
                    }
                },
                tooltip: {
                    shared: true,
                    valueSuffix: '$'
                },
                series: [{
                    name: 'Sales',
                    data: @json(array_values($salesChartData)),
                    fillOpacity: 0.2,
                    color: 'rgba(75, 192, 192, 1)',
                    lineWidth: 2,
                    marker: {
                        enabled: true,
                        radius: 4
                    }
                }]
            });

            // Customer retention chart configuration
            // Customer Retention Chart
            Highcharts.chart('customerRetentionChart', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'Customer Retention Rate (Last 30 Days)'
                },
                xAxis: {
                    categories: @json(array_reverse(array_map(function ($date) {
                        return \Carbon\Carbon::parse($date)->format('M j');
                    }, array_keys($customerRetentionChartData)))),
                },
                yAxis: {
                    title: {
                        text: 'Customers'
                    }
                },
                tooltip: {
                    shared: true,
                },
                series: [{
                    name: 'Returning Customers',
                    data: @json(array_values($customerRetentionChartData)),
                    fillOpacity: 0.2,
                    color: 'rgba(54, 162, 235, 1)',
                    lineWidth: 2,
                    marker: {
                        enabled: true,
                        radius: 4
                    }
                }]
            });
        });

        function recentOrders() {
            return {
                orders: [],
                loading: true,
                error: null,
                loadRecentOrders() {
                    const apiUrl = "{{ route('orders.recent') }}"; 
                    fetch(apiUrl)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            this.orders = data.orders; // Adjust according to your API response structure
                            this.loading = false;
                        })
                        .catch(err => {
                            this.error = err.message; // This will set the error message correctly
                            this.loading = false;
                        });
                }
            };
        }
    </script>

</x-app-layout>
