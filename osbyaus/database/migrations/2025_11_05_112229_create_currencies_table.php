<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('code', 3)->unique(); // e.g. USD
            $table->string('name');
            $table->string('symbol', 5);
            $table->boolean('is_default')->default(true);
            $table->timestamps();
        });

        // Insert default currency: Australian Dollar
        DB::table('currencies')->insert([
            'code' => 'AUD',
            'name' => 'Australian Dollar',
            'symbol' => '$',
            'is_default' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void {
        Schema::dropIfExists('currencies');
    }
};
