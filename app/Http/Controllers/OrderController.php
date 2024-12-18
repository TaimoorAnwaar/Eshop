<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->orderBy('created_at', 'desc')->paginate(4);

        return view('manager.order.index', compact('orders'));
    }
    public function update(Request $request, Order $order)
{
    $request->validate([
        'status' => 'required|in:pending,completed,cancelled',
    ]);


  
    $order->status = $request->status;
    $order->save();

    return redirect()->route('manager.order.index')->with('success', 'Order status updated successfully!');
}
public function orderHistory()
{
    $userId = auth()->id(); 

   
    $orders = Order::where('user_id', $userId)->orderBy('created_at', 'desc')->paginate(10);

    
    return view('manager.order.history', compact('orders'));
}
}



