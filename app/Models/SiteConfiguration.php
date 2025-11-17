<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class SiteConfiguration extends Model
{
    protected $fillable = [
        'site_name',
        'site_email',
        'notification_email',
        'site_phone',
        'site_address',
        'site_city',
        'site_state',
        'site_country',
        'site_postal_code',

        'contact_email',
        'contact_phone',
        'emergency_phone',
        'support_phone',
        'whatsapp_phone',

        'logo',
        'auth_logo',
        'admin_logo',
        'favicon',

        'facebook_url',
        'twitter_url',
        'instagram_url',
        'youtube_url',

        'currency',
        'currency_symbol',

        'gemini_api_key',
        'stripe_publish_key',
        'stripe_secret_key',
        'google_map_api_key',
        'commission_rate',
        'commission_type',
    ];

    /**
     * Get the singleton instance of site configuration
     */
    public static function getConfig()
    {
        static $config = null;
        if ($config === null) {
            $config = self::firstOrCreate(['id' => 1]);
        }
        return $config;
    }

    /**
     * Get formatted address
     */
    public function getFormattedAddressAttribute()
    {
        return implode(', ', array_filter([
            $this->site_address,
            $this->site_city,
            $this->site_state,
            $this->site_country,
            $this->site_postal_code
        ]));
    }


    /**
     * Get Stripe publishable key
     */
    public static function stripe_publish_key(): string
    {
        return self::getConfig()->stripe_publish_key ?? env('STRIPE_KEY', '');
    }

    /**
     * Get Stripe secret key
     */
    public static function stripe_secret(): string
    {
        return self::getConfig()->stripe_secret_key ?? env('STRIPE_SECRET', '');
    }

    /**
     * Get commission rate with fallback
     */
    public static function commission_rate(): float
    {
        return (float) (self::getConfig()->commission_rate ?? 2.00);
    }

    /**
     * Get commission type
     */
    public static function commission_type(): string
    {
        return self::getConfig()->commission_type ?? 'fixed';
    }


    public static function getAppConfig(): array
    {
        $config = self::getConfig();

        return [
            'site_info' => [
                'site_name' => $config->site_name,
                'site_email' => $config->site_email,
                'site_phone' => $config->site_phone,
                'formatted_address' => $config->formatted_address,
                'currency' => $config->currency,
                'currency_symbol' => $config->currency_symbol,
            ],
            'contact_info' => [
                'contact_email' => $config->contact_email,
                'contact_phone' => $config->contact_phone,
                'emergency_phone' => $config->emergency_phone,
                'support_phone' => $config->support_phone,
                'whatsapp_phone' => $config->whatsapp_phone,
            ],
            'media' => [
                'logo' => $config->logo ? asset('storage/' . $config->logo) : null,
                'auth_logo' => $config->auth_logo ? asset('storage/' . $config->auth_logo) : null,
                'favicon' => $config->favicon ? asset('storage/' . $config->favicon) : null,
            ],
            'social_links' => [
                'facebook' => $config->facebook_url,
                'twitter' => $config->twitter_url,
                'instagram' => $config->instagram_url,
                'youtube' => $config->youtube_url,
            ],
            'apis' => [
                'stripe_publish_key' => $config->stripe_publish_key,
                'google_map_api_key' => $config->google_map_api_key,
            ],
            'business' => [
                'commission_rate' => (float) $config->commission_rate,
                'commission_type' => $config->commission_type,
            ]
        ];
    }

    /**
     * Get minimal config for app initialization
     */
    public static function getMinimalConfig(): array
    {
        $config = self::getConfig();

        return [
            'site_name' => $config->site_name,
            'logo' => $config->logo ? asset('storage/' . $config->logo) : null,
            'auth_logo' => $config->auth_logo ? asset('storage/' . $config->auth_logo) : null,
            'currency_symbol' => $config->currency_symbol,
            'stripe_publish_key' => $config->stripe_publish_key,
        ];
    }

}

