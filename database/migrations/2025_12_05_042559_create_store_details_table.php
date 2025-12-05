<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_store_details_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('store_details', function (Blueprint $table) {
            $table->id();
            $table->string('store_name');
            $table->string('email');
            $table->string('phone');
            $table->text('address');
            $table->string('city');
            $table->string('state');
            $table->string('profile_image')->nullable();
            $table->decimal('delivery_charges', 10, 2)->default(0);
            $table->decimal('gst_tax', 5, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('store_details');
    }
};