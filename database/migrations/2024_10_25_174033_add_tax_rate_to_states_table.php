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
        Schema::table('states', function (Blueprint $table) {
            $table->decimal('tax_rate', 10, 2)->default(0.00)->after('delivery_fee')->comment('Tax rate % ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('states', 'tax_rate')) {
            Schema::table('states', function (Blueprint $table) {
                $table->dropColumn('tax_rate');
            });
        }
    }
};
