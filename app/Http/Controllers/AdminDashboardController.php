<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        // Get the start and end dates for the current week
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        // Get the start and end dates for the previous week
        $startOfLastWeek = $startOfWeek->copy()->subWeek();
        $endOfLastWeek = $endOfWeek->copy()->subWeek();

        // Calculate Total Revenue for the current week and previous week
        $currentWeekRevenue = Order::whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('total');
        $previousWeekRevenue = Order::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->sum('total');

        // Calculate revenue change
        $revenueChange = $previousWeekRevenue > 0
            ? (($currentWeekRevenue - $previousWeekRevenue) / $previousWeekRevenue * 100).'%'
            : 'N/A'; // Avoid division by zero

        // Calculate Total Orders for the current week and previous week
        $currentWeekOrders = Order::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
        $previousWeekOrders = Order::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->count();

        // Calculate orders change
        $ordersChange = $previousWeekOrders > 0
        ? (($currentWeekOrders - $previousWeekOrders) / $previousWeekOrders * 100).'%'
        : 'N/A'; // Avoid division by zero

        // Calculate New Customers for the current week and previous week
        $currentWeekNewCustomers = User::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
        $previousWeekNewCustomers = User::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->count();

        // Calculate new customers change
        $customersChange = $previousWeekNewCustomers > 0
        ? (($currentWeekNewCustomers - $previousWeekNewCustomers) / $previousWeekNewCustomers * 100).'%'
        : 'N/A'; // Avoid division by zero

        // Calculate total orders
        $totalOrders = Order::count();

        // Calculate changes in orders
        $previousWeekOrders = Order::where('created_at', '<', now()->startOfWeek())
            ->where('created_at', '>=', now()->subWeek()->startOfWeek())
            ->count();

        $ordersChange = $previousWeekOrders > 0
            ? (($totalOrders - $previousWeekOrders) / $previousWeekOrders) * 100
            : 0;

        // Top-Selling Product
        $topSellingProductData = Product::withCount('orderItems')
            ->orderBy('order_items_count', 'desc')
            ->first();

        $topSellingProduct = $topSellingProductData ? $topSellingProductData->name : 'N/A'; // Replace 'name' with your actual product name column
        $unitsSold = $topSellingProductData ? $topSellingProductData->orders_count : 0;

        // Fetch sales data for the last 7 days
        $salesData = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total) as total'))
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total', 'date');

        // Prepare data for chart
        $salesChartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $salesChartData[] = isset($salesData[$date]) ? $salesData[$date] : 0;
        }

        // Fetch customer retention data (e.g., returning customers)
        $customerRetentionData = User::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(id) as total'))
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total', 'date');

        // Prepare customer retention data for chart (last 30 days)
        $customerRetentionChartData = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $customerRetentionChartData[] = isset($customerRetentionData[$date]) ? $customerRetentionData[$date] : 0;
        }

        return view('dashboard', compact(
            'currentWeekRevenue',
            'revenueChange',
            'totalOrders',
            'ordersChange',
            'topSellingProduct',
            'unitsSold',
            'currentWeekNewCustomers',
            'customersChange',
            'salesChartData',
            'customerRetentionChartData',
        ));
    }
}
