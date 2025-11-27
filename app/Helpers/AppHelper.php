<?php

namespace App\Helpers;

use App\Models\Currency;
use App\Models\SiteConfiguration;
use Illuminate\Support\Facades\Storage;

class AppHelper
{
    /**
     * Get the single site configuration record
     */
    public static function config(): SiteConfiguration
    {
        return SiteConfiguration::getConfig();
    }

    /**
     * Site Info
     */
    public static function site_name(): string
    {
        return self::config()->site_name ?? config('app.name', 'Laravel');
    }

    public static function notification_email(): string
    {
        return self::config()->notification_email ?? env('ADMIN_EMAIL', 'admin@example.com');
    }

    public static function contact_email(): string
    {
        return self::config()->contact_email
            ?? self::config()->site_email
            ?? 'contact@example.com';
    }

    public static function contact_phone(): string
    {
        return self::config()->contact_phone
            ?? self::config()->site_phone
            ?? '+61 400 000 000';
    }

    public static function whatsapp_phone(): string
    {
        return self::config()->whatsapp_phone
            ?? self::config()->site_phone
            ?? '+61 400 000 000';
    }

    public static function emergency_phone(): string
    {
        return self::config()->emergency_phone ?? '';
    }

    public static function support_phone(): string
    {
        return self::config()->support_phone ?? '';
    }

    /**
     * Social Links
     */
    public static function facebook(): string
    {
        return self::config()->facebook_url ?? '#';
    }

    public static function twitter(): string
    {
        return self::config()->twitter_url ?? '#';
    }

    public static function instagram(): string
    {
        return self::config()->instagram_url ?? '#';
    }

    public static function youtube(): string
    {
        return self::config()->youtube_url ?? '#';
    }

    /**
     * Logo Handling
     */
    protected static function logoFields(): array
    {
        return [
            'logo' => 'site/images/logo.svg',
            'auth_logo' => 'auth/images/logo-full.png',
            'admin_logo' => 'admin/assets/images/logo-light.png',
            'favicon' => 'site/assets/images/logo/favicon.png',
        ];
    }

    public static function getLogo(string $type): string
    {
        $default = self::logoFields()[$type] ?? self::logoFields()['logo'];
        $file = self::config()->{$type};

        return $file
            ? Storage::url($file)
            : asset($default);
    }

    public static function logo(): string
    {
        return self::getLogo('logo');
    }

    public static function auth_logo(): string
    {
        return self::getLogo('auth_logo');
    }

    public static function admin_logo(): string
    {
        return self::getLogo('admin_logo');
    }

    public static function fav_icon(): string
    {
        return self::getLogo('favicon');
    }

    /**
     * Currency Handling
     */
    public static function currency(): string
    {
        return self::config()->currency ?? Currency::where('is_default', true)->value('code') ?? 'AUD';
    }

    public static function currency_symbol(): string
    {
        return self::config()->currency_symbol
            ?? Currency::where('is_default', true)->value('symbol')
            ?? '$';
    }

    public static function currency_name(): string
    {
        return Currency::where('is_default', true)->value('name') ?? 'AUD';
    }

    /**
     * Stripe / Payment API Keys
     */
    public static function stripe_publish_key(): string
    {
        return self::config()->stripe_publish_key ?? env('STRIPE_KEY', '');
    }

    public static function stripe_secret(): string
    {
        return self::config()->stripe_secret_key ?? env('STRIPE_SECRET', '');
    }

    /**
     * Commission Settings
     */
    public static function commission_rate(): float
    {
        return (float) self::config()->commission_rate ?? 10.00;
    }

    public static function commission_type(): string
    {
        return self::config()->commission_type ?? 'percentage';
    }
    public static function checkImageExists($imagePath)
    {
        if (!$imagePath) {
            return false;
        }

        try {
            $cleanPath = ltrim($imagePath, '/\\');
            $publicPath = public_path($cleanPath);
            if (file_exists($publicPath)) {
                return true;
            }

            // Also check in storage as fallback
            if (Storage::disk('public')->exists($cleanPath)) {
                return true;
            }

            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function getProductImage($product)
    {
        if ($product->images && $product->images->count() > 0) {
            foreach ($product->images as $image) {
                if (self::checkImageExists($image->image_path)) {
                    return $image->image_path;
                }
            }
        }

        $defaultImages = [
            'website/assets/images/product/01.png',
            'website/assets/images/product/04.png',
        ];

        foreach ($defaultImages as $defaultImage) {
            if (self::checkImageExists($defaultImage)) {
                return $defaultImage;
            }
        }

        return 'website/assets/images/product/01.png';
    }

    public static function getProductImageUrl($product)
    {
        $imagePath = self::getProductImage($product);
        if (str_contains($imagePath, 'uploads/')) {
            return asset($imagePath);
        }
        return asset($imagePath);
    }


    public static function getProductImages($product)
    {
        $validImages = [];
        $clothingDefault = 'website/assets/images/product/01.png';
        $defaultImage = 'website/assets/images/product/04.png';

        // Check if product has images in database
        if ($product->images && $product->images->count() > 0) {
            foreach ($product->images as $image) {
                if (self::checkImageExists($image->image_path)) {
                    $validImages[] = $image;
                }
            }
        }

        // If no valid images found, use fallbacks
        if (empty($validImages)) {
            if (self::checkImageExists($clothingDefault)) {
                $validImages[] = (object)[
                    'image_path' => $clothingDefault,
                    'alt' => $product->name
                ];
            } else {
                $validImages[] = (object)[
                    'image_path' => $defaultImage,
                    'alt' => $product->name
                ];
            }
        }

        return $validImages;
    }

}
