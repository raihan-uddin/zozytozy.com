<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Variant extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'size', 'color', 'price', 'sku', 'stock'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
