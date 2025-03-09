<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'home_page_title',
        'email',
        'phone',
        'address',
        'logo_src',
        'website',
        'status',
        'show_in_front',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    public function scopeFeatured($query)
    {
        return $query->where('show_in_front', 1);
    }

    public function getLogoSrcAttribute($value)
    {
        return $value ? asset('storage/'.$value) : null;
    }

    public function scopeOrderByName($query)
    {
        return $query->orderBy('name');
    }
}
