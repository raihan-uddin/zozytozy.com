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
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained()->onDelete('cascade');
            $table->integer('zip_code')->nullable();
            $table->decimal('latitude', 15, 8)->nullable();
            $table->decimal('longitude', 15, 8)->nullable();
            $table->string('city', 255)->default('');
            $table->string('state', 255)->default('');
            $table->string('county', 255)->default('');
            $table->decimal('delivery_fee', 10, 2)->default(0.00);
            $table->string('status', 20)->default('active')->comment('active, inactive');
            $table->softDeletes();
            $table->timestamps();

            // index
            $table->index('country_id');
            $table->index('city');
            $table->index('state');
            $table->index('county');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('states');
    }
};
