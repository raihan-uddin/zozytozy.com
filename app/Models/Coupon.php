<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code', 'type', 'value', 'min_order_value', 
        'start_date', 'end_date', 'usage_limit', 
        'usage_per_user', 'active'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'active' => 'boolean',
    ];

    public function isValidFor($userId)
    {
        $now = now();
        return $this->active 
            && $this->start_date <= $now 
            && $this->end_date >= $now 
            && (!$this->usage_limit || $this->usage_limit > $this->redemptions()->count())
            && (!$this->usage_per_user || $this->redemptions()->where('user_id', $userId)->count() < $this->usage_per_user);
    }

    public function redemptions()
    {
        return $this->hasMany(CouponRedemption::class);
    }
    
    // scope to get active coupons
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    // scope code wise filter
    public function scopeCode($query, $code)
    {
        return $query->where('code', $code);
    }

    // scope start_date & end_date wise filter
    public function scopeValid($query)
    {
        $now = now();
        return $query->where('active', true)
            ->where('start_date', '<=', $now)
            ->where('end_date', '>=', $now);
    }

    public static function applyCoupon($couponCode, $subtotal, $userId)
    {
        $coupon = self::active()->code($couponCode)->valid()->first();

        if (!$coupon) {
            return [
                'valid' => false,
                'discount' => 0,
                'total' => $subtotal,
            ];
        }
        // calculate discount amount
        $discount = 0;
        if ($coupon->type === 'fixed') {
            $discount = $coupon->value;
        } elseif ($coupon->type === 'percent') {
            $discount = ($coupon->value / 100) * $subtotal;
        }


        $discount = round($discount, 2);
        info($coupon);
        info($discount);
        info($subtotal);
        return [
            'valid' => true,
            'discount' => round(min($discount, $subtotal), 2),
            'total' => round(($subtotal - $discount), 2),
            'coupon' => $coupon,
            'given_subtotal' => $subtotal,
        ];
    }
}
