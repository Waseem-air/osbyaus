<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('order_items')) {
            Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_variant_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('custom_size_id')->nullable()->constrained()->onDelete('set null');

            $table->string('product_name');
            $table->text('product_description')->nullable();
            $table->string('product_sku');
            $table->decimal('price', 10, 2);
            $table->integer('quantity');
            $table->decimal('total', 10, 2);

            // Variant details
            $table->json('selected_options')->nullable(); // color, size, etc.
            $table->string('color_name')->nullable();
            $table->string('size_name')->nullable();

            // Custom size details
            $table->json('custom_size_details')->nullable();

            $table->timestamps();
        });
        }
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};
