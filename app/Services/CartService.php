<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;

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
            ->firstOrCreate([
            'user_id' => auth()->id(),
            'is_guest' => false,
        ]);
    }
}
