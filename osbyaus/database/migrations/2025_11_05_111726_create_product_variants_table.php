<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_color_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('product_size_id')->nullable()->constrained()->onDelete('cascade');
            $table->decimal('price', 10, 2);
            $table->integer('stock_quantity')->default(0);
            $table->string('sku')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('product_variants');
    }
};
