<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('site_configurations', function (Blueprint $table) {
            $table->id();

            // Basic Information
            $table->string('site_name');
            $table->string('site_email')->nullable();
            $table->string('notification_email')->nullable();
            $table->string('site_phone')->nullable();
            $table->string('site_address')->nullable();
            $table->string('site_city')->nullable();
            $table->string('site_state')->nullable();
            $table->string('site_country')->nullable();
            $table->string('site_postal_code')->nullable();

            // Contact Information
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('emergency_phone')->nullable();
            $table->string('support_phone')->nullable();

            // Media
            $table->string('logo')->nullable();
            $table->string('auth_logo')->nullable();
            $table->string('admin_logo')->nullable();
            $table->string('favicon')->nullable();

            // Social Media
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('youtube_url')->nullable();

            // Payment Configuration
            $table->string('currency')->default('AUD');
            $table->string('currency_symbol')->default('$');

            // API Keys
            $table->text('open_ai_key')->nullable();
            $table->text('stripe_api_key')->nullable();
            $table->text('stripe_secret_key')->nullable();

            // Commission Configuration
            $table->decimal('commission_rate', 8, 2)->default(10.00);
            $table->enum('commission_type', ['percentage', 'fixed'])->default('percentage');

            $table->timestamps();
        });

        // Insert default Australian configuration
        DB::table('site_configurations')->insert([
            'site_name' => 'Osbyaus',
            'site_email' => 'info@osbyaus.com.au',
            'notification_email' => 'notify@osbyaus.com.au',
            'site_phone' => '+61 2 9123 4567',
            'site_address' => '45 George Street',
            'site_city' => 'Sydney',
            'site_state' => 'NSW',
            'site_country' => 'Australia',
            'site_postal_code' => '2000',
            'contact_email' => 'contact@osbyaus.com.au',
            'contact_phone' => '+61 400 123 456',
            'emergency_phone' => '+61 2 9876 5432',
            'support_phone' => '+61 2 9999 8888',
            'facebook_url' => 'https://facebook.com/osbyaus',
            'instagram_url' => 'https://instagram.com/osbyaus',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('site_configurations');
    }
};
