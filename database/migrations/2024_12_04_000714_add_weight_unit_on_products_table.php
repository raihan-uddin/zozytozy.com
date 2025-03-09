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
        Schema::table('products', function (Blueprint $table) {
            $table->string('weight_unit')->default('oz')->after('weight')->comment('Ounces (oz), Pounds (lb), Grams (g), Kilograms (kg)');
        });

        Schema::table('variants', function (Blueprint $table) {
            $table->decimal('weight', 8, 2)->nullable()->after('size')->comment('Weight of the product');
            $table->string('weight_unit')->nullable()->after('weight')->comment('Ounces (oz), Pounds (lb), Grams (g), Kilograms (kg)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('products', 'weight_unit')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('weight_unit');
            });
        }

        if (Schema::hasColumn('variants', 'weight')) {
            Schema::table('variants', function (Blueprint $table) {
                $table->dropColumn('weight');
            });
        }

        if (Schema::hasColumn('variants', 'weight_unit')) {
            Schema::table('variants', function (Blueprint $table) {
                $table->dropColumn('weight_unit');
            });
        }
    }
};
