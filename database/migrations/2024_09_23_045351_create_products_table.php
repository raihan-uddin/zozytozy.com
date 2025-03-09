<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // SEO-friendly URL slug
            $table->string('slug')->unique();
            $table->text('short_description')->nullable(); // Product Short description
            $table->text('full_description')->nullable(); // Product Full description
            $table->string('sku')->nullable(); // Stock Keeping Unit
            // vendor_id is a foreign key to the vendors table to establish a relationship on delete set null
            $table->foreignId('vendor_id')->nullable()->constrained()->nullOnDelete();

            // Pricing and Taxation
            $table->decimal('price', 10, 2); // Default price, could be overridden by variants
            $table->decimal('discount_price', 10, 2)->nullable(); // Discount price
            $table->decimal('tax_rate', 5, 2)->default(0); // Tax rate for the product
            $table->boolean('is_taxable')->default(true); // Flag to indicate if the product is taxable

            // Stock management
            $table->integer('stock_quantity')->default(0); // Quantity in stock
            $table->boolean('in_stock')->default(true); // Stock status
            $table->boolean('allow_out_of_stock_orders')->default(false);
            $table->unsignedInteger('low_stock_threshold')->nullable(); // Low stock notification threshold
            $table->unsignedInteger('min_order_quantity')->nullable(); // Minimum quantity allowed for an order
            $table->unsignedInteger('max_order_quantity')->nullable(); // Maximum quantity allowed for an order

            // Additional metadata
            $table->string('barcode')->nullable(); // Barcode if applicable
            $table->decimal('weight', 8, 2)->nullable(); // Weight of the product
            $table->decimal('length', 8, 2)->nullable(); // Dimensions
            $table->decimal('width', 8, 2)->nullable();
            $table->decimal('height', 8, 2)->nullable();

            // Product visibility options
            $table->boolean('is_featured')->default(false); // Featured product
            $table->boolean('is_visible')->default(true); // Whether the product is visible in listings
            $table->boolean('is_digital')->default(false); // Is it a digital product?

            // Product status: draft, published, archived, etc.
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft'); // Status management
            $table->timestamp('published_at')->nullable(); // Publishing time for products

            $table->json('recommended_products')->nullable(); // JSON field for upselling recommended products

            // Reviews & Ratings
            $table->boolean('allow_reviews')->default(true); // Allow customers to review the product
            $table->decimal('average_rating', 3, 2)->nullable(); // Average customer rating
            $table->unsignedInteger('total_reviews')->default(0); // Total number of reviews

            // Promotions
            $table->boolean('is_on_promotion')->default(false); // Promotion flag
            $table->json('promotion_details')->nullable(); // Store details like banner text, expiration date

            $table->string('featured_image')->nullable(); // Primary product image

            // SEO Fields
            $table->string('meta_title')->nullable(); // Meta title for SEO
            $table->text('meta_description')->nullable(); // Meta description for SEO
            $table->string('meta_keywords')->nullable(); // Meta keywords for SEO

            // full text search
            $table->text('full_text')->nullable();

            // Soft Deletes & Timestamps
            $table->softDeletes(); // Support for soft deletes
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
