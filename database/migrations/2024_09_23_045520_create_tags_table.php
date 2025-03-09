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
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Tag name (unique)
            $table->string('slug')->unique(); // SEO-friendly slug
            $table->string('description', 2000)->nullable(); // Tag description
            $table->boolean('is_active')->default(true); // Active or inactive
            $table->string('bg_color', 9)->nullable();
            $table->string('text_color', 9)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};
