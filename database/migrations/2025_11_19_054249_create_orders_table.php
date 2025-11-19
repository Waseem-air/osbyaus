<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
                $table->id();
                $table->string('order_number')->unique();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->decimal('subtotal', 10, 2);
                $table->decimal('tax_amount', 10, 2)->default(0);
                $table->decimal('shipping_amount', 10, 2)->default(0);
                $table->decimal('total_amount', 10, 2);
                $table->string('status')->default('pending'); // pending, processing, completed, cancelled
                $table->string('payment_status')->default('pending'); // pending, paid, failed
                $table->string('payment_method')->default('card');
                $table->string('stripe_payment_intent_id')->nullable();
                $table->string('stripe_session_id')->nullable();
                $table->string('stripe_customer_id')->nullable();

                // Billing Address
                $table->string('billing_first_name');
                $table->string('billing_last_name');
                $table->string('billing_email');
                $table->string('billing_phone');
                $table->text('billing_address');
                $table->string('billing_city')->nullable();
                $table->string('billing_state')->nullable();
                $table->string('billing_country')->nullable();
                $table->string('billing_postal_code')->nullable();

                // Shipping Address
                $table->string('shipping_first_name')->nullable();
                $table->string('shipping_last_name')->nullable();
                $table->string('shipping_email')->nullable();
                $table->string('shipping_phone')->nullable();
                $table->text('shipping_address')->nullable();
                $table->string('shipping_city')->nullable();
                $table->string('shipping_state')->nullable();
                $table->string('shipping_country')->nullable();
                $table->string('shipping_postal_code')->nullable();

                $table->text('order_notes')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
