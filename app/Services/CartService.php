<?php

namespace App\Services;

use App\Models\Cart;

class CartService
{
    public function getUserCart()
    {
        $sessionId = session()->id();

        if (!auth()->check()) {
            return Cart::query()->where('session_id', $sessionId)->firstOrCreate([
                'session_id' => $sessionId,
                'is_guest' => true,
            ]);
        }

        return Cart::query()
            ->where('user_id', auth()->id())
            ->where('session_id', $sessionId)
            ->firstOrCreate([
            'user_id' => auth()->id(),
            'session_id' => $sessionId,
            'is_guest' => false,
        ]);
    }

    public function getTotalPrice($cartItems)
    {
        $total = 0;
        foreach($cartItems as $item) {
            $total += $item->product->price * $item->quantity;
        }
        return $total;
    }

    public function getTotalQuantity($cartItems)
    {
        $total = 0;
        foreach($cartItems as $item) {
            $total += $item->quantity;
        }
        return $total;
    }
}
