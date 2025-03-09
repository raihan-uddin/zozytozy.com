<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class UserController extends Controller
{
    public function dashboard()
    {
        $totalOrders = Order::where('user_id', auth()->id())->count();
        $pendingOrders = Order::where('user_id', auth()->id())->where('status', 'pending')->count();
        $completedOrders = Order::where('user_id', auth()->id())->where('status', 'completed')->count();
        $totalProducts = Order::where('user_id', auth()->id())->sum('total_items');
        $totalSpent = 0;
        $recommendedProducts = [];
        $recentOrders = Order::where('user_id', auth()->id())->latest()->take(10)->get();
        return view('frontend.user.dashboard', compact(
            'totalOrders', 
            'pendingOrders', 
            'completedOrders', 
            'totalSpent',
            'totalProducts',
            'recommendedProducts', 
            'recentOrders'
        ));
    }
}
