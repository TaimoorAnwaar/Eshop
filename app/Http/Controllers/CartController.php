<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\TestEmail;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Mail;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        // $mail =  Mail::to('recipient@example.com')->send(new TestEmail());
        // dd($mail);
        $product = Product::findOrFail($id);
        $userId = auth()->id(); 
    
        $cartItem = CartItem::where('user_id', $userId)->where('product_id', $id)->first();
    
        if ($cartItem) {
            
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
           
            CartItem::create([
                'user_id' => $userId,
                'product_id' => $id,
                'quantity' => 1,
            ]);
        }
    
      
        $cartCount = CartItem::where('user_id', $userId)->sum('quantity');
    
       
        session()->put('cart-count', $cartCount); 
    
       
        $cartItems = CartItem::where('user_id', $userId)->get();
        session()->put('cart', $cartItems);
    
        return response()->json([
            'success' => true, 
            'cart_count' => $cartCount, 
            'message' => 'Product added to cart!'
        ]);
    }
    
    

    public function viewCart()
    {
        $userId = auth()->id(); 
        $cart = CartItem::with('product')->where('user_id', $userId)->get();
    
        //cart update ho raha hai session k sath////
        $cartCount = CartItem::where('user_id', $userId)->sum('quantity');
        session(['cart_count' => $cartCount]);
    
        return view('cart.index', compact('cart'));
    }
    

    public function removeFromCart($id)
    {
        $userId = auth()->id(); 

        $cartItem = CartItem::where('user_id', $userId)->where('product_id', $id)->first();

        if ($cartItem) {
            $cartItem->delete();
        }
        $cartCount = CartItem::where('user_id', $userId)->sum('quantity');
        
        session()->put('cart-count', $cartCount); 
        // $cartItems = CartItem::where('user_id', $userId)->get();
        // session()->put('cart', $cartItems);

        return redirect()->back()->with('success', 'Product removed from cart!');
    }
}




