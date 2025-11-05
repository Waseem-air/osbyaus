<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'discount_price',
        'stock_quantity',
        'status',
        'sku',
        'brand',
        'thumbnail',
        'is_featured',
        'is_new_arrival',
        'fabric',
        'fit',
        'style',
        'tags',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_new_arrival' => 'boolean',
        'tags' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            $product->slug = $product->slug ?? Str::slug($product->name);
        });
    }

    /** Relationships */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function sizes()
    {
        return $this->hasMany(ProductSize::class);
    }

    public function colors()
    {
        return $this->hasMany(ProductColor::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    /** Accessor for discounted price */
    public function getFinalPriceAttribute()
    {
        return $this->discount_price ?? $this->price;
    }
}
