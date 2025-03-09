<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'image',
        'link',
        'section',
        'order_column',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function scopeActive($query)
    {
        return $query->where('banners.is_active', true);
    }
}
