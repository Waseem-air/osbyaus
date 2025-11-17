<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('colors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('hex_code');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // ✅ Insert Top 10 Common Colors
        $colors = [
            ['name' => 'Black',       'hex_code' => '#000000'],
            ['name' => 'White',       'hex_code' => '#FFFFFF'],
            ['name' => 'Red',         'hex_code' => '#FF0000'],
            ['name' => 'Blue',        'hex_code' => '#0000FF'],
            ['name' => 'Green',       'hex_code' => '#008000'],
            ['name' => 'Yellow',      'hex_code' => '#FFFF00'],
            ['name' => 'Purple',      'hex_code' => '#800080'],
            ['name' => 'Orange',      'hex_code' => '#FFA500'],
            ['name' => 'Pink',        'hex_code' => '#FFC0CB'],
            ['name' => 'Sky Blue',    'hex_code' => '#87CEEB'],
        ];

        DB::table('colors')->insert(array_map(function ($color) {
            return array_merge($color, [
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }, $colors));
    }

    public function down()
    {
        Schema::dropIfExists('colors');
    }
};
