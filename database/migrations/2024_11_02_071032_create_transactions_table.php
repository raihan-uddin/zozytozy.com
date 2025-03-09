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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            // user_id is optional, if the user is not logged in
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->unsignedBigInteger('order_id')->index(); // Foreign key to orders table
            $table->string('stripe_id')->nullable()->comment('Stripe payment ID');
            $table->string('transaction_id')->unique()->comment(('Unique transaction ID'));
            $table->decimal('amount', 10, 2)->comment('Amount in the currency');
            $table->string('currency', 10)->comment('Currency code (USD, EUR, BDT etc.)');
            $table->string('payment_status')->default('pending')->comment('Payment status: pending, paid, failed, etc.');
            $table->string('payment_method')->nullable()->comment('Payment method: stripe, paypal, etc.');
            $table->text('payment_response')->nullable()->comment('Payment gateway response');
            $table->timestamp('paid_at')->nullable()->comment('Timestamp when the payment was completed');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
