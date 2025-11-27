<?php
// app/Models/SocialMediaLink.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMediaLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'instagram',
        'facebook',
        'pinterest',
        'tiktok',
    ];

    protected $table = 'social_media_links';

    // Get the first (and only) record
    public static function getSocialLinks()
    {
        return static::firstOrCreate([]);
    }
}