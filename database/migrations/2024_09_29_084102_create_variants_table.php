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
        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('size')->nullable();  // Size of the variant
            $table->string('color')->nullable(); // Color of the variant
            $table->decimal('price', 8, 2);  // Price of the variant
            $table->string('sku')->nullable();  // Optional SKU for the variant
            $table->integer('stock')->default(0);  // Stock of the variant
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variants');
    }
};
