<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use App\Services\CartService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->get();
        $users = User::query()->get();
        $cartItems = CartItem::query()->where('session_id', session()->id())->get();
        $totalQuantity = resolve(CartService::class)->getTotalQuantity($cartItems);

        return view('products.index', compact('products', 'users', 'totalQuantity'));
    }

    public function addToCart(Request $request, Product $product)
    {
        $quantity = $request->input('quantity', 1);
        $cartService = resolve(CartService::class);
        $cartService->addToCart($product, $quantity);


        return redirect()->back()->with('success', 'Product added to cart!');
    }
}
