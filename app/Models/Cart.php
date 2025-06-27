<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'session_id',
        'is_guest',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function cartItems(): \Illuminate\Database\Eloquent\Relations\HasMany|Cart
    {
        return $this->hasMany(CartItem::class);
    }

    public function getTotalPrice(): float|int
    {
        $cartItems = $this->cartItems;
        $total = 0;
        foreach($cartItems as $item) {
            $total += $item->product->price * $item->quantity;
        }
        return $total;
    }

    public function getTotalQuantity()
    {
        $cartItems = $this->cartItems;
        $total = 0;
        foreach($cartItems as $item) {
            $total += $item->quantity;
        }
        return $total;
    }
}
