<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Only authenticated user can place order
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string', //|unique:products,slug,' . $product->id,
            'sku' => 'nullable|string', //|unique:products,sku,' . $product->id,
            'vendor_id' => 'nullable|numeric',
            'categories' => 'required|array',
            'tags' => 'nullable|array',
            'full_description' => 'nullable|string',
            'price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'tax_rate' => 'nullable|numeric',
            'is_taxable' => 'nullable|boolean',
            'stock_quantity' => 'required|integer',
            'in_stock' => 'nullable|boolean',
            'allow_out_of_stock_orders' => 'nullable|boolean',
            'min_order_quantity' => 'nullable|integer',
            'max_order_quantity' => 'nullable|integer',
            'barcode' => 'nullable|string',
            'weight' => 'required|numeric',
            'weight_unit' => 'required|in:' . implode(',', Product::WEIGHT_UNIT_ARR),
            'length' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'is_featured' => 'nullable|boolean',
            'is_visible' => 'nullable|boolean',
            'is_digital' => 'nullable|boolean',
            //  status: 'draft', 'published', 'archived'
            'status' => 'required|string|in:draft,published,archived',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            // Product variants [size][], color, price, sku, stock
            'variants' => 'nullable|array',
        ];
    }
}
