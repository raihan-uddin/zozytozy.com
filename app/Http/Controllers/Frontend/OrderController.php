<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all orders of the authenticated user
        $orders = Order::where('user_id', auth()->id())->latest()->paginate(10);
        return view('frontend.user.order.index', compact('orders'));
    }

    public function show($order_number)
    {
        // must be user's order
        $order = Order::with(['items.product', 'user'])->where('order_number', $order_number)->where('user_id', auth()->id())->firstOrFail();
        return view('frontend.user.order.show', compact('order'));
    }
}
