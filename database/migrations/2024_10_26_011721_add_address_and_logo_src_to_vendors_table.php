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
        Schema::table('vendors', function (Blueprint $table) {
            $table->string('address')->nullable()->after('phone');
            $table->string('logo_src')->nullable()->after('address');
            $table->string('website')->nullable()->after('logo_src');
            $table->string('status')->default('active')->comment('active, inactive')->after('website');
            $table->boolean('show_in_front')->default(true)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('logo_src');
            $table->dropColumn('website');
            $table->dropColumn('status');
            $table->dropColumn('show_in_front');
        });
    }
};