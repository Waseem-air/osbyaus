<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('cart_items')) {
            Schema::create('cart_items', function (Blueprint $table) {
                $table->id();
                $table->foreignId('cart_id')->nullable();
                $table->foreignId('product_id')->nullable();
                $table->foreignId('product_variant_id')->nullable();
                $table->foreignId('custom_size_id')->nullable();
                $table->integer('quantity')->default(1);
                $table->decimal('price', 10, 2)->default(0.00);
                $table->decimal('total', 10, 2)->default(0.00);
                $table->json('selected_options')->nullable(); // {color_id: 1, size_id: 2}
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
};
