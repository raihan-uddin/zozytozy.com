<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_number',
        'user_id',
        'guest_email',
        'guest_name',
        'guest_phone',
        'payment_status',
        'payment_method',
        'transaction_id',
        'payment_amount',
        'payment_completed_at',
        'payment_response',
        'shipping_name',
        'shipping_address',
        'shipping_address2',
        'shipping_city',
        'shipping_state',
        'shipping_zip',
        'shipping_country',
        'shipping_status',
        'shipped_at',
        'billing_name',
        'billing_address',
        'billing_address2',
        'billing_city',
        'billing_state',
        'billing_zip',
        'billing_country',
        'tax_rate',
        'tax_amount',
        'coupon_code',
        'discount_amount',
        'total_items',
        'subtotal',
        'shipping_cost',
        'total',
        'currency',
        'metadata',
        'status',
        'completed_at',
        'cancelled_at',
        'notes',
        'ip_address',
        'user_agent',
        'affiliate_id',
        'loyalty_points_earned',
        'loyalty_points_redeemed',
        'is_gift',
        'gift_message',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'payment_completed_at' => 'datetime',
        'shipped_at' => 'datetime',
        'completed_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'metadata' => 'array',
        'gift_message' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->order_number = (string) Str::uuid();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function transaction()
    {
        return $this->hasOne(Payment::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function statuses()
    {
        return $this->hasMany(OrderStatus::class);
    }
}
