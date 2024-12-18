<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $products = Product::paginate(6); // Sare products fetch karega
        return view('manager.products.index', compact('products')); // manager/products/index.blade.php render karega
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manager.products.create'); // manager/products/create.blade.php render karega
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Validate image
        ]);
    
        // Store the product data
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->description = $request->description;
    
        // Handle the image upload if exists
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public'); // Store the image in 'public/products' folder
            $product->image = $imagePath;
        }
    
        $product->save($validated);
    
        return redirect()->route('manager.products.index')->with('success', 'Product added successfully!');
    }
    

   
    public function show(Product $product)
    {
        return view('manager.products.show', compact('product')); // manager/products/show.blade.php render karega
    }

   
    public function edit(Product $product)
    {
        return view('manager.products.edit', compact('product')); // manager/products/edit.blade.php render karega
    }

   
    public function update(Request $request, Product $product)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
        'image' => 'nullable|image|max:2048', 
        'stock'=>  'required|numeric',
    ]);

    if ($request->hasFile('image')) {
        if ($product->image) {
            Storage::delete('public/products/' . $product->image);
        }

        $imagePath = $request->file('image')->store('products', 'public'); // Store in 'storage/app/public/products'
        
        $validated['image'] = $imagePath;
    }

    $product->update($validated);

    return redirect()->route('manager.products.index')->with('success', 'Product updated successfully!');
}

   
    public function destroy(Product $product)
    {
       
        $product->delete(); 
    
        
        return response()->json('success');
    }
   


  
    

  

    

}    

