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
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();

            // Address details
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('city')->nullable();
            $table->foreignId('state_id')->constrained('states')->onDelete('cascade');
            $table->foreignId('country_id')->constrained()->onDelete('cascade');
            $table->string('zip_code')->nullable();

            // Address type and defaults
            $table->enum('type', ['billing', 'shipping', 'other'])->default('shipping');
            $table->boolean('is_default')->default(false);

            // Address Validation and Tracking
            $table->boolean('is_validated')->default(false);
            $table->timestamp('validated_at')->nullable();

            // Geolocation
            $table->decimal('latitude', 12, 8)->nullable();
            $table->decimal('longitude', 12, 8)->nullable();

            $table->timestamps();

            // Composite Indexes
            $table->index(['user_id', 'is_default']);       // Index for quick default address retrieval
            $table->index(['country_id', 'state_id']);      // Index for geographic-based queries
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_addresses');
    }
};
