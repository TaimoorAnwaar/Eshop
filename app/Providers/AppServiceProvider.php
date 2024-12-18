<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            if (Auth::check()) {
                $userId = Auth::id();
                $cartCount = CartItem::where('user_id', $userId)->sum('quantity');
                session(['cart_count' => $cartCount]);
            }
        });
    }
}

