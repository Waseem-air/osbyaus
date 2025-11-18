<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'user_id',
        'subtotal',
        'total',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    protected $withCount = ['items'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function getItemsCountAttribute()
    {
        return $this->items->sum('quantity');
    }

    public function updateTotals()
    {
        $this->subtotal = $this->items->sum('total');
        $this->total = $this->subtotal;
        $this->save();
    }
}
