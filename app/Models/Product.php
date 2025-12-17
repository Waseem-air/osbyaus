<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'discount_price',
        'stock_quantity',
        'status',
        'sku',
        'fabric',
        'embellishment',
        'cut',
    ];

    protected $casts = [
        'status' => 'string',
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            $product->slug = $product->slug ?? Str::slug($product->name);
        });
    }

    /** Relationships - CORRECTED */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category', 'product_id', 'category_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }


    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    /** Accessors */
    public function getMainImageAttribute()
    {
        return $this->images->where('is_main', true)->first() ?? $this->images->first();
    }

    public function getFinalPriceAttribute()
    {
        return $this->discount_price ?? $this->price;
    }

    public function getDiscountPercentageAttribute()
    {
        if ($this->discount_price && $this->price > 0) {
            return round((($this->price - $this->discount_price) / $this->price) * 100);
        }
        return 0;
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_colors', 'product_id', 'color_id')
            ->withTimestamps();
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_sizes', 'product_id', 'size_id')
            ->withTimestamps();
    }

    public function productColors()
    {
        return $this->hasMany(ProductColor::class);
    }

    public function productSizes()
    {
        return $this->hasMany(ProductSize::class);
    }


    // In your Product model (App\Models\Product.php)

// Update the active() scope method:
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

// Update the popularThisWeek() scope method:
    public function scopePopularThisWeek($query)
    {
        return $query->where('status', 'active')
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->orderBy('created_at', 'desc');
    }

    /**
     * Get users who have this product in their wishlist.
     */
    public function wishlistedByUsers()
    {
        return $this->belongsToMany(User::class, 'wishlists', 'product_id', 'user_id')
            ->withTimestamps();
    }

    /**
     * Get wishlist entries for this product.
     */
    public function wishlistEntries()
    {
        return $this->hasMany(Wishlist::class);
    }
    // In Product.php model, add this scope method
public function scopePopular($query, $limit = 5)
{
    return $query->where('status', 'active')
        ->withCount(['orderItems as total_quantity' => function ($query) {
            $query->select(\DB::raw('COALESCE(SUM(quantity), 0)'));
        }])
        ->orderBy('total_quantity', 'desc')
        ->limit($limit);
}

// Also make sure you have this relationship
public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}

}
