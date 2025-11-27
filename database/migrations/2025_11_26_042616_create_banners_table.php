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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable(); // Banner image path
            $table->string('top_text')->nullable(); // Top text
            $table->string('main_title')->nullable(); // Main title
            $table->string('sub_title')->nullable(); // Sub title
            $table->text('details')->nullable(); // Details
            $table->boolean('is_active')->default(true); // Status
             $table->boolean('is_right_text')->default(false); // Status
            $table->integer('sort_order')->default(0); // For ordering banners
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};