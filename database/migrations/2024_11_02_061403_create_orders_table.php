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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->uuid('order_number')->unique(); // Using UUID

            // Foreign key to users table (assuming orders are linked to a registered user)
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');

            // Nullable columns for guest orders (if applicable)
            $table->string('guest_email')->nullable();
            $table->string('guest_name')->nullable();
            $table->string('guest_phone')->nullable();

            // Payment information
            $table->string('payment_status')->default('pending'); // pending, paid, failed, etc.
            $table->string('payment_method')->nullable(); // Credit card, PayPal, etc.
            $table->string('transaction_id')->nullable(); // For payment gateway tracking
            $table->decimal('payment_amount', 15, 2)->default(0.00); // Total amount paid
            $table->timestamp('payment_completed_at')->nullable(); // Timestamp when the payment was completed
            $table->text('payment_response')->nullable();

            // Shipping information
            $table->string('shipping_method')->default('store_pickup')->comment('Shipping method: store_pickup, economy etc.');
            $table->string('shipping_name')->nullable();
            $table->string('shipping_address')->nullable();
            $table->string('shipping_address2')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_state')->nullable();
            $table->foreignId('shipping_state_id')->nullable()->constrained('states')->onDelete('set null');
            $table->string('shipping_zip')->nullable();
            $table->string('shipping_country')->default('US');
            $table->foreignId('shipping_country_id')->nullable()->constrained('countries')->onDelete('set null');
            $table->string('shipping_status')->default('pending'); // pending, shipped, delivered, etc.
            $table->timestamp('shipped_at')->nullable(); // Timestamp when the order was shipped

            // Billing information
            $table->string('billing_name')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('billing_address2')->nullable();
            $table->string('billing_city')->nullable();
            $table->string('billing_state')->nullable();
            $table->string('billing_zip')->nullable();
            $table->string('billing_country')->default('US');

            // Tax information

            $table->decimal('tax_rate', 5, 2)->default(0.00); // Example: 7.5 for 7.5%
            $table->decimal('tax_amount', 15, 2)->default(0)->comment('Sales tax');

            // Coupon/Discount information
            $table->string('coupon_code')->nullable(); // Code applied to the order
            $table->decimal('discount_amount', 15, 2)->default(0.00); // Total discount applied to the order

            // Order details
            $table->integer('total_items')->default(0);
            $table->decimal('subtotal', 15, 2)->comment('Total cost before taxes, shipping etc.'); // Total cost before taxes, shipping, delivery fees, etc.

            $table->decimal('shipping_cost', 15, 2)->default(0.00)->comment('Shipping cost');
            $table->decimal('total', 15, 2)->comment('Subtotal + tax + shipping');  // Final total after tax and shipping
            $table->string('currency')->default('USD'); // Currency code (USD, EUR, etc.)

            // Order status and audit information
            $table->json('metadata')->nullable(); // To store any extra order information like internal notes, or custom fields
            $table->string('status')->default('pending'); // Order status 'pending', 'processing', 'completed', 'cancelled', 'refunded', etc.

            // Timestamps for order lifecycle
            $table->timestamp('completed_at')->nullable(); // Date when the order was completed
            $table->timestamp('cancelled_at')->nullable(); // Date when the order was cancelled

            // Additional notes
            $table->text('notes')->nullable();

            // Additional columns for better tracking and management
            $table->string('ip_address')->nullable(); // IP address of the customer
            $table->string('user_agent')->nullable(); // User agent string for tracking device type, browser, etc.
            $table->string('affiliate_id')->nullable(); // For tracking sales through affiliates

            // Advanced analytics and performance tracking
            $table->integer('loyalty_points_earned')->default(0); // Points earned through loyalty programs
            $table->integer('loyalty_points_redeemed')->default(0); // Points redeemed for discounts
            $table->boolean('is_gift')->default(false); // If the order is marked as a gift
            $table->json('gift_message')->nullable(); // Optional message if the order is a gift

            // Audit columns
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');

            // Soft deletes for orders
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
