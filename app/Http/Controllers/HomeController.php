<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     public function About(){
        if (Auth::user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard'); 
        }
        elseif( Auth::user()->hasROle('manager')){
            return redirect()->route('manager/products');
        }

        return view('about');
     }
    public function index()
    {
       

        $products=Product::paginate(6   );
    
        return view('home', compact('products')); 
    }
    public function getProductDetails($id)
{
    $product = Product::findOrFail($id);

    return response()->json([
        'id' => $product->id,
        'name' => $product->name,
        'description' => $product->description,
        'price' => number_format($product->price, 2),
        'image' => $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/150',
        'stock' => $product->stock,
    ]);
}
}
