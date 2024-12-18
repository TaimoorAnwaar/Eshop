<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

{{-- resources/views/manager/notification.blade.php --}}
@extends('layouts.app')

@section('content')
    <style>
        body {
            background-color: #f8f9fa;
        }

        .notifications-container {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .notification-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .notification-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .notification-card h5 {
            font-size: 1.25rem;
            color: #0056b3;
        }

        .notification-card p {
            font-size: 0.95rem;
            color: #495057;
        }

        .notification-card small {
            font-size: 0.85rem;
            color: #6c757d;
        }

        .btn-custom {
            font-size: 0.875rem;
            padding: 5px 15px;
            border-radius: 20px;
        }

        .btn-view {
            background-color: #17a2b8;
            color: white;
        }

        .btn-view:hover {
            background-color: #138496;
        }

        .btn-mark-read {
            background-color: #28a745;
            color: white;
        }

        .btn-mark-read:hover {
            background-color: #218838;
        }

        .btn-clear {
            background-color: #dc3545;
            color: white;
        }

        .btn-clear:hover {
            background-color: #c82333;
        }
    </style>

    <div class="container mt-5">
        <div class="text-center mb-5">
            <h2 class="text-primary">Notifications</h2>
            <p class="text-muted">Stay updated with your latest notifications.</p>
        </div>

        <div class="d-flex justify-content-end mb-3">
            @if (count($notifications) > 0)
                <form action="{{ route('notifications.clear') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-clear btn-sm">Clear All Notifications</button>
                </form>
            @endif
        </div>

        <div class="notifications-container">
            @if (count($notifications) === 0)
                <div class="alert alert-info text-center">
                    <p class="mb-0"><i class="fas fa-bell-slash fa-2x mb-3"></i></p>
                    <p class="mb-0">No new notifications.</p>
                </div>
            @else
                <div class="row">
                    @foreach ($notifications as $notification)
                        <div class="col-md-6 mb-4">
                            <div class="card notification-card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <i class="fas fa-box-open me-2"></i>Order ID: {{ $notification->data['order_id'] }}
                                    </h5>
                                    <p class="card-text">{{ $notification->data['message'] }}</p>
                                    <p><strong>Total:</strong> ${{ number_format($notification->data['order_total'], 2) }}</p>
                                    <p><strong>Customer:</strong> {{ $notification->data['customer_name'] }}</p>
                                    <small class="d-block mb-3">
                                        Sent {{ $notification->created_at->diffForHumans() }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
