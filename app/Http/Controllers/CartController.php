<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addProduct(Product $product)
    {
        $cartItem = CartItem::query()
                ->where('product_id', $product->id)
                ->first();

        //можна додати додатковий метод для оновлення ціни
        if ($cartItem) {
            $cartItem->increment('quantity');
            $cartItem->price = $cartItem->quantity * $product->price;
        }

        //можна створити додаткой метод для створення нового товару в кошику і винести в сервіс
        if (!$cartItem) {

            $cart = resolve(CartService::class)->getUserCart();

            CartItem::query()->create([
                'product_id' => $product->id,
                'cart_id' => $cart->id,
                'quantity' => 1,
                'price' => $product->price,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function index()
    {
        $cart = resolve(CartService::class)->getUserCart();

        $cartItems = CartItem::query()->where('cart_id', $cart->id)->with('product')->get();

        $totalPrice = $cart->getTotalPrice();

        $totalQuantity = $cart->getTotalQuantity();

        return view('cart.index', compact('cart', 'totalPrice', 'totalQuantity', 'cartItems'));
    }

    public function updateQuantity(Request $request)
    {
        $cartItem = CartItem::query()->findOrFail($request->cartItemId);

        if ($request->quantity > 0) {
            $cartItem->quantity = $request->quantity;
            $cartItem->price = $cartItem->quantity * $cartItem->product->price;
            $cartItem->save();
        }

        return redirect()->back()->with('success', 'Кількість оновлено');
    }


    public function remove(Request $request)
    {
        $cartItem = CartItem::query()->findOrFail($request->cartItemId);
        $cartItem->delete();
        return redirect()->back()->with('success', 'Товар видалено з кошика');
    }
}
