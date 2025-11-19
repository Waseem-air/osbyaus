<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('custom_sizes')) {
            Schema::create('custom_sizes', function (Blueprint $table) {
                $table->id();
                $table->foreignId('product_id')->nullable();
                // Shirt measurements
                $table->decimal('shirt_length', 8, 2)->nullable();
                $table->decimal('shoulder', 8, 2)->nullable();
                $table->decimal('chest', 8, 2)->nullable();
                $table->decimal('waist', 8, 2)->nullable();
                $table->decimal('hips', 8, 2)->nullable();
                $table->decimal('sleeves_length', 8, 2)->nullable();

                // Trouser measurements
                $table->decimal('waist_stretch', 8, 2)->nullable();
                $table->decimal('waist_relax', 8, 2)->nullable();
                $table->decimal('thigh', 8, 2)->nullable();
                $table->decimal('calf', 8, 2)->nullable();
                $table->decimal('trouser_bottom', 8, 2)->nullable();
                $table->decimal('trouser_length', 8, 2)->nullable();

                $table->text('additional_notes')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('custom_sizes');
    }
};
