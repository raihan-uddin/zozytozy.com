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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable();
            $table->string('slug', 100)->nullable();
            $table->foreignId('country_id')
                ->constrained('countries')
                ->comment('In which country the HQ is located');
            $table->string('phone', 20)->nullable();
            $table->string('logo_src', 2048)->nullable();
            $table->string('website', 2048)->nullable();
            $table->string('keywords', 2000)->nullable();
            $table->string('description', 2000)->nullable();
            $table->string('bg_color', 10)->nullable();
            $table->string('text_color', 10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
