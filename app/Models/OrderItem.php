<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'product_id', 'product_variant_id', 'custom_size_id',
        'product_name', 'product_description', 'product_sku', 'price',
        'quantity', 'total', 'selected_options', 'color_name', 'size_name',
        'custom_size_details'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'total' => 'decimal:2',
        'selected_options' => 'array',
        'custom_size_details' => 'array',
    ];

    // Relationships
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }

    public function customSize()
    {
        return $this->belongsTo(CustomSize::class);
    }

    // Methods
    public function updateTotal()
    {
        $this->total = $this->price * $this->quantity;
        $this->save();
    }

    public function getVariantDetailsAttribute()
    {
        if ($this->variant) {
            $details = [];
            if ($this->color_name) $details[] = "Color: {$this->color_name}";
            if ($this->size_name) $details[] = "Size: {$this->size_name}";
            return implode(', ', $details);
        }
        return null;
    }
}
