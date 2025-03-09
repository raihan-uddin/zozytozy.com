<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Services\CouponService;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $coupons = Coupon::latest()->paginate(100)->withQueryString();
        $pageTitle = 'Coupons';

        return view('admin.coupons.index', compact('coupons', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Create Coupon';

        return view('admin.coupons.create', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'type' => 'required|string',
            'value' => 'required|numeric',
            'min_order_value' => 'nullable|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'active' => 'required|boolean',
            'description' => 'nullable|string',
        ]);

        $coupon = new Coupon;
        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->value = $request->value;
        $coupon->min_order_value = $request->min_order_value;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->usage_limit = $request->usage_limit;
        $coupon->usage_per_user = $request->usage_per_user;
        $coupon->active = $request->active;
        $coupon->description = $request->description;
        $coupon->save();

        return redirect()->route('coupons.index')->with('success', 'Coupon created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        $pageTitle = 'Edit Coupon';

        return view('admin.coupons.edit', compact('coupon', 'pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'code' => 'required|string',
            'type' => 'required|string',
            'value' => 'required|numeric',
            'min_order_value' => 'nullable|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'active' => 'required|boolean',
            'description' => 'nullable|string',
        ]);

        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->value = $request->value;
        $coupon->min_order_value = $request->min_order_value;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->usage_limit = $request->usage_limit;
        $coupon->usage_per_user = $request->usage_per_user;
        $coupon->active = $request->active;
        $coupon->description = $request->description;
        if ($coupon->save()) {
            return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully');
        } else {
            return back()->with('error', 'Coupon update failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return redirect()->route('coupons.index')->with('success', 'Coupon deleted successfully');
    }

    public function apply(Request $request, CouponService $couponService)
    {
        $request->validate(['code' => 'required|string']);

        $cartTotal = $request->cart_total;
        $userId = $request->user()->id;

        $validation = $couponService->validateCoupon($request->code, $userId, $cartTotal);

        if (! $validation['status']) {
            return response()->json(['error' => $validation['message']], 400);
        }

        $newTotal = $couponService->applyCoupon($validation['coupon'], $cartTotal);

        return response()->json(['success' => true, 'new_total' => $newTotal]);
    }
}
