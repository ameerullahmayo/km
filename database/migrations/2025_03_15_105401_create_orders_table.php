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
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Link to customers table
            $table->string('order_number')->unique(); // Unique Order Number
            
            // Order Amount Details
            $table->decimal('subtotal', 10, 2)->default(0.00); // Total before discount & tax
            $table->decimal('discount', 10, 2)->default(0.00); // Discount applied
            $table->decimal('tax', 10, 2)->default(0.00); // Tax applied
            $table->decimal('shipping_cost', 10, 2)->default(0.00); // Shipping cost
            $table->decimal('total_price', 10, 2)->default(0.00); // Final total amount
            
            // Order Status
            $table->enum('order_status', ['pending', 'processing', 'shipped', 'delivered', 'cancelled', 'returned'])->default('pending');
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'refunded'])->default('pending');
            $table->enum('shipping_status', ['pending', 'shipped', 'in_transit', 'delivered', 'returned'])->default('pending');
            $table->string('tracking_number')->nullable(); // Shipping tracking ID
            
            // Payment Information
            $table->string('payment_method')->nullable(); // Visa, MasterCard, PayPal, COD, etc.
            $table->string('transaction_id')->nullable(); // Unique transaction ID (from payment gateway)
            
            // Secure Card Information (Only Last 4 Digits for Security)
            $table->string('card_type')->nullable(); // Visa, MasterCard, etc.
            $table->string('card_last_four')->nullable(); // Last 4 digits of the card
            $table->string('card_expiry')->nullable(); // Card expiry date (MM/YY)
        
            // **Billing Address (Where the payment is processed)**
            $table->text('billing_address')->nullable(); // Full billing address
            $table->string('billing_city')->nullable();
            $table->string('billing_state')->nullable();
            $table->string('billing_postal_code')->nullable();
            $table->string('billing_country')->nullable();
        
            // **Shipping Address (Where the order is delivered)**
            $table->text('shipping_address')->nullable(); // Full shipping address
            $table->string('shipping_city')->nullable();
            $table->string('shipping_state')->nullable();
            $table->string('shipping_postal_code')->nullable();
            $table->string('shipping_country')->nullable();
            
            // Order Timestamps
            $table->timestamp('ordered_at')->useCurrent(); // Order placed timestamp
            $table->timestamp('shipped_at')->nullable(); // Order shipped timestamp
            $table->timestamp('delivered_at')->nullable(); // Order delivered timestamp
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
