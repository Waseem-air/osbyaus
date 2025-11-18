<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomSize extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'shirt_length',
        'shoulder',
        'chest',
        'waist',
        'hips',
        'sleeves_length',
        'waist_stretch',
        'waist_relax',
        'thigh',
        'calf',
        'trouser_bottom',
        'trouser_length',
        'additional_notes',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
