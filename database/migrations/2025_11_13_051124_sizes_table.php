<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sizes', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., Small, Medium
            $table->string('short_code', 5)->nullable(); // e.g., S, M, L, XL
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Insert default sizes
        DB::table('sizes')->insert([
            ['name' => 'Small', 'short_code' => 'S', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Medium', 'short_code' => 'M', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Large', 'short_code' => 'L', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'X-Large', 'short_code' => 'XL', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sizes');
    }
};
