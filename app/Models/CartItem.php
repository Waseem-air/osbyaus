<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_id',
        'product_variant_id',
        'custom_size_id',
        'quantity',
        'price',
        'total',
        'selected_options',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'total' => 'decimal:2',
        'selected_options' => 'array',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
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

    public function updateTotal()
    {
        $this->total = $this->price * $this->quantity;
        $this->save();
    }

    public function getOptionsDisplayAttribute()
    {
        if (!$this->selected_options) return '';

        $options = [];
        if (isset($this->selected_options['color_id'])) {
            $color = Color::find($this->selected_options['color_id']);
            if ($color) $options[] = $color->name;
        }
        if (isset($this->selected_options['size_id'])) {
            $size = Size::find($this->selected_options['size_id']);
            if ($size) $options[] = $size->name;
        }

        return implode(', ', $options);
    }
}
