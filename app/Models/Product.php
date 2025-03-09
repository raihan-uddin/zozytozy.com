<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

// use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    // use Searchable;

    const WEIGHT_UNIT_ARR = [
        'oz',
        'lb',
        'g',
        'kg',
        'mg',
        'l',
        'ml',
        'gal',
    ];

    public function getWeightUnit()
    {
        return self::WEIGHT_UNIT_ARR;
    }

    // public function toSearchableArray()
    // {
    //     return [
    //         'id' => $this->id,
    //         'name' => $this->name,
    //         'slug' => $this->slug,
    //         'price' => $this->price,
    //         'discount_price' => $this->discount_price,
    //         'featured_image' => $this->featured_image,
    //         'is_featured' => $this->is_featured,
    //         'is_visible' => $this->is_visible,
    //         'full_description' => $this->full_description,
    //         'vendor' => $this->vendor ? $this->vendor->name : null,
    //         'categories' => $this->categories->pluck('name')->toArray(),
    //         'tags' => $this->tags->pluck('name')->toArray(),
    //         'created_at' => $this->created_at,
    //     ];
    // }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'full_description',
        'sku',
        'price',
        'discount_price',
        'tax_rate',
        'is_taxable',
        'stock_quantity',
        'in_stock',
        'allow_out_of_stock_orders',
        'low_stock_threshold',
        'min_order_quantity',
        'max_order_quantity',
        'barcode',
        'weight',
        'length',
        'width',
        'height',
        'is_featured',
        'is_visible',
        'is_digital',
        'status',
        'published_at',
        'recommended_products',
        'allow_reviews',
        'average_rating',
        'total_reviews',
        'is_on_promotion',
        'promotion_details',
        'featured_image',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'vendor_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'published_at' => 'datetime',
        'recommended_products' => 'array',
        'promotion_details' => 'array',
        'is_taxable' => 'boolean',
        'is_featured' => 'boolean',
        'is_visible' => 'boolean',
        'is_digital' => 'boolean',
        'allow_out_of_stock_orders' => 'boolean',
        'allow_reviews' => 'boolean',
        'is_on_promotion' => 'boolean',
        'price' => 'decimal:2',

    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'product_tag');
    }

    public function variants(): HasMany
    {
        return $this->HasMany(Variant::class, 'product_id', 'id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Define a method to count the orders through order items
    public function orders()
    {
        return $this->hasManyThrough(Order::class, OrderItem::class);
    }

    // Relationship with ProductImage
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    // Accessor for full image URL
    public function getImageUrlAttribute()
    {
        return $this->featured_image ? asset('storage/'.$this->featured_image) : null;
    }

    public function getGalleryImagesAttribute()
    {
        return $this->images->where('is_featured', false);
    }

    // Accessor to calculate the final price including tax
    public function getFinalPriceAttribute()
    {
        return $this->is_taxable
            ? round($this->price * (1 + $this->tax_rate / 100), 2)
            : $this->price;
    }

    // Accessor to calculate discount percentage
    public function getDiscountPercentageAttribute()
    {
        return $this->discount_price
            ? round((($this->price - $this->discount_price) / $this->price) * 100, 2)
            : 0;
    }

    /**
     * Scopes
     */
    // Scope for filtering published products
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // Scope for filtering featured products
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Scope for filtering visible products
    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    /**
     * Custom Methods
     */

    // Check if the product is on sale (has a discount)
    public function isOnSale()
    {
        return $this->discount_price && $this->discount_price < $this->price;
    }

    // Calculate the final price after discount
    public function finalPrice()
    {
        return $this->isOnSale() ? $this->discount_price : $this->price;
    }

    // Check if the product is in stock
    public function isInStock()
    {
        return $this->stock_quantity > 0 && $this->in_stock;
    }

    // Check if out of stock orders are allowed
    public function canOrderWhenOutOfStock()
    {
        return $this->allow_out_of_stock_orders;
    }

    // decrement stock
    public function decrementStock($quantity)
    {
        $this->stock_quantity -= $quantity;
        $this->save();
    }

    // increment stock
    public function incrementStock($quantity)
    {
        $this->stock_quantity += $quantity;
        $this->save();
    }

    // decrement stock of a product variant
    public function decrementStockOfVariant($variant, $quantity)
    {
        $variant->stock -= $quantity;
        $variant->save();
    }

    /*
    * convert weight to ounces
    * @param string $baseUnit
    * @param float $weight
    * @return float
    */
    public function weightToOunces($baseUnit, $weight): float
    {
        switch ($baseUnit) {
            case 'oz':
                return $weight;
            case 'lb':
                return $weight * 16;
            case 'g':
                return $weight * 0.035274;
            case 'kg':
                return $weight * 35.274;
            case 'mg':
                return $weight * 0.000035274;
            case 'l':
                return $weight * 33.814;
            case 'ml':
                return $weight * 0.033814;
            case 'gal':
                return $weight * 128;
            default:
                return $weight;
        }
    }

    /*
    * convert weight to pounds
    * @param string $baseUnit
    * @param float $weight
    * @return float
    */
    public function weightToPounds($baseUnit, $weight): float
    {
        return $this->weightToOunces($baseUnit = 'oz', $weight) / 16;
    }
}
