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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Foreign key to orders table
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Foreign key to products table
            $table->string('product_name'); // Name of the product
            $table->string('sku')->nullable(); // Stock Keeping Unit, if applicable
            $table->decimal('quantity', 10, 2)->default(1); // Quantity of the product
            $table->decimal('price', 15, 2); // Price of the product at the time of order
            $table->decimal('purchase_price', 15, 2)->nullable(); // Purchase price of the product
            $table->decimal('subtotal', 15, 2); // Subtotal for the item (quantity * price)
            $table->decimal('discount', 15, 2)->default(0.00); // Discount applied to the item, if any
            $table->integer('variant_id')->nullable(); // ID of the product variant, if applicable
            $table->string('size')->nullable(); // Size of the product, if applicable
            $table->string('color')->nullable(); // Color of the product, if applicable
            $table->json('variant_data')->nullable(); // JSON field for storing variant attributes (size, color, etc.)
            // Item status for tracking
            $table->enum('status', ['in_stock', 'backordered', 'shipped', 'returned', 'cancelled'])->default('in_stock'); // Current status of the item
            $table->softDeletes(); // Soft delete support
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
