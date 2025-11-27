<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_social_media_links_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialMediaLinksTable extends Migration
{
    public function up()
    {
        Schema::create('social_media_links', function (Blueprint $table) {
            $table->id();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('pinterest')->nullable();
            $table->string('tiktok')->nullable();
            $table->timestamps();
        });

        // Insert default record
        DB::table('social_media_links')->insert([
            'instagram' => null,
            'facebook' => null,
            'pinterest' => null,
            'tiktok' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('social_media_links');
    }
}