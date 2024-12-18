@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Cart</h1>

    <a href="{{ route('home') }}" class="btn btn-primary text-white mb-3">Home</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($cart->isNotEmpty())
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->product->description ?? 'N/A' }}</td>
                    <td>${{ number_format($item->product->price, 2) }}</td>
                    <td>${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                    <td>
                        <form action="{{ route('cart.remove', $item->product_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Calculate total price -->
        @php
            $total = $cart->sum(fn($item) => $item->product->price * $item->quantity);
        @endphp

        <div class="d-flex justify-content-between align-items-center mt-4">
            <h4>Total Price: ${{ number_format($total, 2) }}</h4>
            <!-- Checkout Button -->
            <a href="{{ route('checkout.form') }}" class="btn btn-success">Proceed to Checkout</a>
        </div>

    @else
        <p>Your cart is empty!</p>
    @endif
</div>
@endsection
