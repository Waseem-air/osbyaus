<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('product_sizes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('name'); // e.g. XS, S, M, L, XL
            $table->decimal('bust', 6, 2)->nullable();
            $table->decimal('waist', 6, 2)->nullable();
            $table->decimal('hip', 6, 2)->nullable();
            $table->decimal('length', 6, 2)->nullable();
            $table->decimal('shoulder', 6, 2)->nullable();
            $table->decimal('sleeve', 6, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('product_sizes');
    }
};
