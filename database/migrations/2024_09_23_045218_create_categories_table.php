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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->integer('order_column')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_menu')->default(true);  // This will help distinguish between menu and submenu
            $table->boolean('show_on_nav_menu')->default(true);
            $table->boolean('show_on_home')->default(false);
            $table->boolean('show_on_footer')->default(false);
            $table->boolean('show_on_sidebar')->default(false);
            $table->boolean('show_on_slider')->default(false);
            $table->boolean('show_on_top')->default(false);
            $table->boolean('show_on_bottom')->default(false);
            $table->string('icon')->nullable();
            $table->string('image')->nullable();
            $table->string('keywords', 2000)->nullable();
            $table->string('description', 2000)->nullable();
            $table->string('bg_color', 10)->nullable();
            $table->string('text_color', 10)->nullable();
            $table->string('border_color', 10)->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
