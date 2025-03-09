<?php
namespace App\Services;

use App\Models\Coupon;

class CouponService
{
    public function validateCoupon($code, $userId, $cartTotal)
    {
        $coupon = Coupon::where('code', $code)->first();

        if (!$coupon) {
            return ['status' => false, 'message' => 'Invalid coupon code.'];
        }

        if (!$coupon->isValidFor($userId)) {
            return ['status' => false, 'message' => 'Coupon is not valid or expired.'];
        }

        if ($coupon->min_order_value && $cartTotal < $coupon->min_order_value) {
            return ['status' => false, 'message' => 'Minimum order value not met.'];
        }

        return ['status' => true, 'coupon' => $coupon];
    }

    public function applyCoupon($coupon, $cartTotal)
    {
        if ($coupon->type === 'fixed') {
            return max(0, $cartTotal - $coupon->value);
        } elseif ($coupon->type === 'percent') {
            return max(0, $cartTotal - ($cartTotal * ($coupon->value / 100)));
        }

        return $cartTotal;
    }
}
