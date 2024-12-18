@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Checkout</h1>

    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="address" class="form-label">Shipping Address</label>
            <textarea name="address" id="address" class="form-control" rows="3" required>{{ old('address') }}</textarea>
        </div>

        @if ($cart->isNotEmpty())
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ number_format($item->product->price, 2) }}</td>
                        <td>${{ number_format($item->quantity * $item->product->price, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <h4>Total: ${{ number_format($total, 2) }}</h4>
        @else
            <p>Your cart is empty.</p>
        @endif

        <button type="submit" class="btn btn-success">Place Order</button>
    </form>
</div>
@endsection
