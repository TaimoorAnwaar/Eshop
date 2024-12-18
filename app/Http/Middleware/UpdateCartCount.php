<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;

class UpdateCartCount
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $cartCount = CartItem::where('user_id', $userId)->sum('quantity');
            session(['cart_count' => $cartCount]);
        }

        return $next($request);
    }
}
