<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number', 'user_id', 'subtotal', 'tax_amount', 'shipping_amount',
        'total_amount', 'status', 'payment_status', 'payment_method','stripe_payment_link',
        'stripe_payment_intent_id','stripe_session_id','stripe_customer_id',
        'billing_first_name', 'billing_last_name', 'billing_email', 'billing_phone',
        'billing_address', 'billing_city', 'billing_state', 'billing_country', 'billing_postal_code',
        'shipping_first_name', 'shipping_last_name', 'shipping_email', 'shipping_phone',
        'shipping_address', 'shipping_city', 'shipping_state', 'shipping_country', 'shipping_postal_code',
        'order_notes', 'customer_name', 'customer_email', 'customer_phone'
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'shipping_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'selected_options' => 'array',
        'custom_size_details' => 'array',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    // Methods
public static function generateOrderNumber()
{
    return 'ORD-' . strtoupper(Str::random(6));
}



    public function getBillingFullNameAttribute()
    {
        return "{$this->billing_first_name} {$this->billing_last_name}";
    }

    public function getShippingFullNameAttribute()
    {
        if ($this->shipping_first_name) {
            return "{$this->shipping_first_name} {$this->shipping_last_name}";
        }
        return $this->billing_full_name;
    }

    public function updateTotals()
    {
        $this->subtotal = $this->items->sum('total');
        $this->total_amount = $this->subtotal + $this->tax_amount + $this->shipping_amount;
        $this->save();
    }

    public function statusHistories()
    {
        return $this->hasMany(OrderStatusHistory::class)->latest();
    }
}
