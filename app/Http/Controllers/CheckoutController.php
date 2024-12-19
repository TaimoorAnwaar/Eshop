<?php

namespace App\Http\Controllers;

use App\Mail\CheckoutMail;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Notifications\CheckoutCompletedDatabase;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
   
    public function showCheckoutForm()
    {
        $userId = auth()->id(); 
        $cart = CartItem::with('product')->where('user_id', $userId)->get();

        $total = $cart->sum(fn($item) => $item->product->price * $item->quantity);

        return view('checkout.form', compact('cart', 'total'));
    }

 
    public function processCheckout(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
        ]);

        $userId = auth()->id();
        $cart = CartItem::with('product')->where('user_id', $userId)->get();

        if ($cart->isEmpty()) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty.');
        }

        
        $totalPrice = $cart->sum(fn($item) => $item->product->price * $item->quantity);

       
        $order = Order::create([
            'user_id' => $userId,
            'total_price' => $totalPrice,
            'address' => $request->address,
        ]);

        
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);

            
            $product = $item->product;
            if ($product) {
                $product->stock -= $item->quantity;
                $product->save();
            }
        }

        
        CartItem::where('user_id', $userId)->delete();
        $cartCount = CartItem::where('user_id', $userId)->sum('quantity');
        session()->put('cart-count', $cartCount); 
       
       
       
       
       
        // for notification
        $managers = User::where('role', 'manager')->get();

        foreach ($managers as $manager) {
            $manager->notify(new CheckoutCompletedDatabase($order));
        }

           Mail::to($order->user->email)->send(new CheckoutMail($order));

        return redirect()->route('checkout.thankyou')->with('success', 'Order placed successfully!');
    

        
    }


   
    public function thankYou()
    {
        return view('checkout.thankyou');
    }
}
