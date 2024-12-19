@extends('layouts.app')

@section('title', 'Manage Products')

@section('content')
<div class="container mt-2">
    <h1 class="text-center text-primary mb-4">Admin Dashboard</h1>
    <h2 class="text-center mb-4">List of Products</h2>

   
    
    
    <div class="row justify-content-center" id="product-list">
        @forelse($products as $product)
        <div class="col-md-4 mb-4 product-item" data-product-id="{{ $product->id }}">
            <div class="card shadow-lg rounded-3 overflow-hidden h-100" style="transition: transform 0.3s ease;">
                <div class="card-img-wrapper" style="height: 200px; overflow: hidden;">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="No Image Available" style="width: 100%; height: 100%; object-fit: cover;">
                    @endif
                </div>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-center text-dark">{{ $product->name }}</h5>
                    <p class="card-text text-center text-dark">Price: ${{ number_format($product->price, 2) }}</p>
                    <div class="mt-auto text-center">
                        <a href="{{ route('manager.products.edit', $product->id) }}" class="btn btn-primary btn-sm mb-2">Edit</a>
                        <button class="btn btn-danger btn-sm mb-2 delete-product" data-id="{{ $product->id }}">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center">
            <p>No products available.</p>
        </div>
        @endforelse
    </div>

    <div class="col-12 mt-4 text-center">
        {{ $products->links('pagination::bootstrap-4') }}
    </div>
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        // Delete product via AJAX
        $('.delete-product').click(function (e) {
            e.preventDefault();

            var productId = $(this).data('id');
            var $productRow = $(this).closest('.product-item'); // Get the parent product item

            // Confirm the deletion action
            $.ajax({
                url: '/manager/products/' + productId, // URL to delete product
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function (response) {
                    // On success, remove the product from the list
                    $productRow.fadeOut(function () {
                        $(this).remove();
                    });
                },
                error: function (xhr, status, error) {
                    // Handle error (you can show an error message here if needed)
                    console.log('Error deleting the product.');
                }
            });
        });
    });
</script>

<style>
    body {
        background-color: rgb(231, 223, 223);
    }

    #product-list {
        display: flex;
        flex-wrap: wrap;
        justify-content: center; /* Center items in the last row */
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .btn {
        padding: 10px 20px;
        font-size: 14px;
        border-radius: 25px;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }

    h1 {
        font-family: 'Arial', sans-serif;
        font-weight: 600;
        color: #004085;
    }

    .col-12 p {
        font-size: 18px;
        color: #777;
    }

    .pagination {
        display: flex;
        justify-content: center; /* Center pagination links */
        margin-top: 20px;
    }

    .pagination .page-item .page-link {
        color: #007bff; /* Default link color */
        border: 1px solid #dee2e6;
    }

    .pagination .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
    }

    .pagination .page-link:hover {
        background-color: #0056b3;
        color: white;
    }
</style>
@endsection
