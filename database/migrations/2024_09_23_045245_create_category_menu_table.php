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
        Schema::create('category_menus', function (Blueprint $table) {
            $table->foreignId('menu_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('submenu_id')->constrained('categories')->onDelete('cascade');

            // Add unique constraint
            $table->unique(['menu_id', 'submenu_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_menus');
    }
};
