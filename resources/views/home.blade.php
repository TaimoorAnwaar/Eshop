
@extends('layouts.app')
@section('title', 'Home','cart-count')
@section('content' )
@Include('layouts.banner') 
<body class="body">
    

   
    <div class="container mt-4">
       
        
        <h1 class="text-center text-primary mb-5 mt-5">All Products</h1>

        <div class="row">
            @forelse($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100 product-card" style="cursor: pointer;" data-id="{{ $product->id }}">
                    <div class="card-img-wrapper position-relative" style="height: 200px; overflow: hidden;">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="width: 100%; height: 110%; object-fit: cover;">
                        @else
                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="No Image Available" style="width: 100%; height: 100%; object-fit: cover;">
                        @endif
            
                     
                        
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                        <p class="card-text text-success fw-bold">Price: ${{ number_format($product->price, 2) }}</p>
            
                    
                        @if($product->stock > 0)
                            <button type="button" class="btn btn-primary w-100 add-to-cart" data-id="{{ $product->id }}">Add to Cart</button>
                        @else
                            <button type="button" class="btn btn-danger w-100" disabled>Out of Stock</button>
                        @endif
                    </div>
                </div>
            </div>
            
            
            @empty
                <div class="col-12">
                    <p class="text-center">No products available at the moment.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center mt-4">
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
    </div>

    <!-- Product Detail Modal -->
    <div class="modal fade" id="productDetailModal" tabindex="-1" aria-labelledby="productDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productDetailModalLabel">Product Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="product-detail-content">
                        <p>Loading...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
   $(document).ready(function () {
       $('.add-to-cart').click(function (e) {
           e.stopPropagation(); 
       });

       $('.product-card').click(function () {
           var productId = $(this).data('id');
           var modal = $('#productDetailModal');

           modal.modal('show');

           $.ajax({
               url: '/products/' + productId, 
               type: 'GET',
               success: function (response) {
                   $('#product-detail-content').html(`
                       <div class="text-center">
                           <img src="${response.image}" alt="${response.name}" class="img-fluid mb-3" style="max-height: 200px;">
                       </div>
                       <h4 class="text-center">${response.name}</h4>
                       <p>${response.description}</p>
                       <p class="text-success fw-bold text-center">Price: $${response.price}</p>
                   `);
               },
               error: function () {
                   $('#product-detail-content').html('<p class="text-danger text-center">Failed to load product details.</p>');
               }
           });
       });

       
       $('.add-to-cart').click(function () {
    var productId = $(this).data('id'); 

    $.ajax({
        url: "{{ route('cart.add', ':id') }}".replace(':id', productId),
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}" 
        },
        success: function (response) {
            if (response.success) {
               
                $('#cart-count').text(response.cart_count);
                swal.fire({
                    title:'Success',
                    text:'Product added successfully',
                    icon:'success',
                });
            } else {
                // alert(response.error || 'Failed to add product to cart.');
                swal.fire(
                    {
                        title: 'Error',
                        text:"Failed to add to cart",
                        icon:'Error',
                    }
                );
            }
        },
        error: function () {
            // alert('Something went wrong while adding the product to the cart.');
            Swal.fire({
    title: "Error",
    text: "You are not logged in.",
    icon: "error",
 
    
    showCancelButton: false,
});
        }
    });
});


});

   
</script>








<style>
    .body{
        background-color: #e0e7ef;
    }
    /* Product Card Styles */
    .product-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        border-radius: 15px;
    }

    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    
    }

    .product-card .card-img-wrapper {
        position: relative;
        overflow: hidden;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .product-card img {
        transition: transform 0.3s ease;
    }

    .product-card:hover img {
        transform: scale(1.1);
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }

    .btn-primary:active {
        transform: scale(0.95);
    }

    .product-card .card-body {
        padding: 20px;
        display: flex;
        flex-direction: column;
    }

    .product-card .card-title {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
    }

    .product-card .card-text {
        font-size: 14px;
        color: #555;
    }

    .card-text.text-success {
        font-size: 16px;
        font-weight: bold;
        color: #28a745;
    }
   /* Cart Button Styles */





   .out-of-stock-badge {
    background-color: rgba(255, 0, 0, 0.8);
    color: white;
    font-size: 14px;
    font-weight: bold;
    text-transform: uppercase;
    z-index: 10;
    opacity: 0.9;
}





</style>
@endsection
