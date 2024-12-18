@extends('layouts.app')

@section('title', 'Order History')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center text-primary mb-4">Your Order History</h1>

            @if(session('success'))
                <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif

            <!-- Check if there are any orders -->
            @if($orders->isEmpty())
                <p class="text-center">You have no orders yet.</p>
            @else
                <div class="table-responsive shadow-sm rounded-lg bg-white p-3">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Order ID</th>
                                <th>User Name</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Order Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->user->name }}</td> 
                                    <td>{{ $order->address ?? 'No address provided' }}</td> 
                                    <td>
                                        <span class="
                                            @if($order->status == 'pending') badge-warning
                                            @elseif($order->status == 'processing') badge-info
                                            @elseif($order->status == 'completed') badge-success
                                            @elseif($order->status == 'cancelled') badge-danger
                                            @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $order->created_at->format('d/m/Y') }}</td> 
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $orders->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
