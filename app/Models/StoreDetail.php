<?php
// app/Models/StoreDetail.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'profile_image',
        'delivery_charges',
        'gst_tax'
    ];

    protected $casts = [
        'delivery_charges' => 'decimal:2',
        'gst_tax' => 'decimal:2'
    ];

    // Get image URL
    public function getProfileImageUrlAttribute()
    {
        if ($this->profile_image) {
            return asset('storage/' . $this->profile_image);
        }
        return asset('admin/images/placeholder.png');
    }
}