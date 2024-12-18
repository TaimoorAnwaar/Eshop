{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@extends('layouts.app')

@section('title', 'Manage Orders')

@section('content')
<div class="container mt-5">
    <h1 class="text-center text-primary mb-4 font-weight-bold">Admin Dashboard</h1>
    <h2 class="text-center mb-5">List of Orders</h2>

    @if($orders->isEmpty())
        <p class="text-center text-muted">No orders found.</p>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover shadow-sm">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Order ID</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Address</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Status</th>
                        <th scope="col">Update Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td class="font-weight-bold">{{ $order->id }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->address }}</td>
                            <td class="text-success">${{ number_format($order->total_price, 2) }}</td>
                            <td>
                                <span class="
                                    @if($order->status == 'pending') badge-warning 
                                    @elseif($order->status == 'completed') badge-success 
                                    @else badge-secondary @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('manager.order.update', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="form-control form-control-sm mb-2">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-primary w-100">Update</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="mt-4 text-center">
            {{ $orders->links('pagination::bootstrap-4') }}
        </div>
    @endif
</div>

<style>
    .table {
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 1rem;
        min-width: 100%;
        background-color: white;
    }
    .table th, .table td {
        text-align: center;
        padding: 15px;
        vertical-align: middle;
    }
    .table-bordered th, .table-bordered td {
        border: 1px solid #dee2e6;
    }
    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }
    .thead-dark th {
        background-color: #343a40;
        color: white;
        border: 1px solid #454d55;
    }
    .badge {
        font-size: 0.85rem;
        padding: 0.5em 0.6em;
    }
    .form-control-sm {
        font-size: 0.9rem;
        padding: 0.25rem 0.5rem;
    }
    .btn-primary {
        transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>

@endsection --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@extends('layouts.app')

@section('title', 'Manage Orders')

@section('content')

    <div class="container mt-5">
       

   
  

    @if($orders->isEmpty())
        <p class="text-center text-muted">No orders found.</p>
    @else
        <div class="table-responsive shadow-sm rounded-lg bg-white p-3">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Order ID</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Address</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Status</th>
                        <th scope="col">Update Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td class="font-weight-bold">{{ $order->id }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->address }}</td>
                            <td class="text-success">${{ number_format($order->total_price, 2) }}</td>
                            <td>
                                <span class="
                                    @if($order->status == 'pending') badge-warning 
                                    @elseif($order->status == 'completed') badge-success 
                                    @elseif($order->status == 'cancelled') badge-danger 
                                    @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('manager.order.update', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="form-control form-control-sm mb-2">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-primary w-100">Update</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="mt-4 paginate">
            <div class="d-flex justify-content-center overflow-auto">
                <!-- Bootstrap pagination with scrollable container -->
                {{ $orders->links('pagination::bootstrap-4') }}
            </div>
        </div>
    @endif
</div>

<style>
    @media (max-width: 576px) {
    .paginate {
        text-align: center; 
    }

    .paginate .pagination {
        font-size: 0.875rem; /* Reduce font size for smaller screens */
    }
}
    body {
        background-color: #f8f9fa;
    }

    table {
        background-color: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    th, td {
        text-align: center;
        vertical-align: middle;
    }

    .table th {
        background-color: #007bff;
        color: white;
        font-weight: bold;
    }

    

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        transition: transform 0.2s, box-shadow 0.2s;

    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
        transform: scale(1.2); /* Enlarge on hover */
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);
        
    }

    .form-control-sm {
        font-size: 0.875rem;
        border-radius: 10px;
    }

    .form-control-sm:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .alert-success {
        margin-bottom: 20px;
    }

    h2, h4 {
        font-family: 'Arial', sans-serif;
        font-weight: 600;
        color: #343a40;
    }
   
</style>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.update-status-button').on('click', function() {
            const button = $(this);
            const form = button.closest('.update-status-form');
            const orderId = form.data('order-id');
            const status = form.find('select[name="status"]').val();

            $.ajax({
                url: `{{ url('/manager/order/update/') }}/${orderId}`,
                type: 'PATCH',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status
                },
                success: function(response) {
                    $(`#status-badge-${orderId}`).text(status.charAt(0).toUpperCase() + status.slice(1));
                    let badgeClass = '';
                    if (status === 'pending') badgeClass = 'badge-warning';
                    else if (status === 'completed') badgeClass = 'badge-success';
                    else if (status === 'cancelled') badgeClass = 'badge-danger';

                    $(`#status-badge-${orderId}`).attr('class', `badge ${badgeClass}`);
                    alert('Order status updated successfully!');
                },
                error: function(error) {
                    alert('Failed to update status. Please try again.');
                }
            });
        });
    });
</script>



@endsection