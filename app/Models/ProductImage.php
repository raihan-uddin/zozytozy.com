<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'image_path',
        'caption',
        'is_featured',
        'order',
    ];

    // Relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getThumbnailAttribute()
    {
        return $this->image_path;
    }

    public function getImageUrlAttribute()
    {
        return asset('storage/'.$this->image_path);
    }

    public function getCaptionAttribute($value)
    {
        return $value ?? '';
    }

    public function getIsFeaturedAttribute($value)
    {
        return (bool) $value;
    }

    public function getOrderAttribute($value)
    {
        return (int) $value;
    }

    public function setCaptionAttribute($value)
    {
        $this->attributes['caption'] = $value;
    }

    public function setIsFeaturedAttribute($value)
    {
        $this->attributes['is_featured'] = (bool) $value;
    }

    public function setOrderAttribute($value)
    {
        $this->attributes['order'] = (int) $value;
    }
}
