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
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('image_path'); // Path to the image file
            $table->string('caption')->nullable(); // Caption for the image
            $table->boolean('is_featured')->default(false)->comment('Is this is the main image of the product.'); // Whether the image is the featured image for the product
            $table->unsignedTinyInteger('order')->default(0); // Order of the image in the product gallery
            $table->string('thumb_size', 50)->nullable(); // Thumbnail size
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
