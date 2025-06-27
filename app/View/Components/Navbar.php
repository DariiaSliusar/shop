<?php

namespace App\View\Components;

use App\Models\User;
use App\Services\CartService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Navbar extends Component
{
    /**
     * Total quantity in the cart.
     */
    public int $totalQuantity;
    public Collection $users;

    /**
     * Create a new component instance.
     */
    public function __construct(
        private readonly CartService $cartService
    ) {
        $cart = $this->cartService->getUserCart();
        $this->totalQuantity = $cart->getTotalQuantity();
        $this->users = User::query()->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navbar');
    }
}
