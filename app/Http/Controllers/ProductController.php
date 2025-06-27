<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Services\CartService;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->get();
        $users = User::query()->get();
        $cart = resolve(CartService::class)->getUserCart();
        $totalQuantity = $cart->getTotalQuantity();

        return view('products.index', compact('products', 'users', 'totalQuantity'));
    }
}
