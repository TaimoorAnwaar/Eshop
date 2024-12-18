@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<h1 class="text-center my-4 text-primary">Edit Product</h1>

<form id="edit-product-form" action="{{ route('manager.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="mx-auto" style="max-width: 600px;">
    @csrf
    @method('PUT')

    <!-- Product Name -->
    <div class="form-group mb-4">
        <label for="name" class="font-weight-bold text-dark">Product Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" required placeholder="Enter product name">
    </div>

    <!-- Price -->
    <div class="form-group mb-4">
        <label for="price" class="font-weight-bold text-dark">Price ($)</label>
        <input type="number" name="price" id="price" class="form-control" value="{{ $product->price }}" required placeholder="Enter price">
    </div>

    <!-- Stock -->
    <div class="form-group mb-4">
        <label for="stock" class="font-weight-bold text-dark">Stock</label>
        <input type="number" name="stock" id="stock" class="form-control" value="{{ $product->stock }}" required placeholder="Enter stock quantity">
    </div>

    <!-- Description -->
    <div class="form-group mb-4">
        <label for="description" class="font-weight-bold text-dark">Description</label>
        <textarea name="description" id="description" class="form-control" placeholder="Enter product description">{{ $product->description }}</textarea>
    </div>

    <!-- Product Image -->
    <div class="form-group mb-4">
        <label for="image" class="font-weight-bold text-dark">Product Image</label>
        @if($product->image)
            <div>
                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="img-thumbnail" style="max-width: 150px;">
            </div>
        @endif
        <input type="file" name="image" id="image" class="form-control">
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary btn-block py-2 mt-3">Update Product</button>
</form>

@endsection

@section('styles')
<style>
    /* Add spacing and improve form container */
    form {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* Adjust heading for a better appearance */
    h1 {
        font-family: 'Arial', sans-serif;
        font-weight: 600;
        color: #004085;
    }

    /* Enhance form labels */
    .form-group label {
        font-size: 16px;
        font-weight: 500;
        color: #495057;
    }

    /* Style input fields */
    .form-control {
        background-color: #ffffff;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 12px;
        font-size: 14px;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        border-color: #28a745;
        box-shadow: 0 0 5px rgba(40, 167, 69, 0.5);
    }

    /* Style the button */
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        font-size: 16px;
        font-weight: 600;
        padding: 12px;
        transition: all 0.3s ease;
        border-radius: 5px;
    }

    .btn-primary:hover {
        background-color: #0069d9;
        border-color: #0062cc;
        transform: translateY(-2px);
    }

    .btn-primary:active {
        transform: translateY(1px);
    }

    /* Style image preview */
    .img-thumbnail {
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 10px;
    }
</style>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#edit-product-form').submit(function(event) {
        event.preventDefault(); // Prevent the default form submission

        var formData = new FormData(this); // Get the form data, including files

        $.ajax({
            url: $(this).attr('action'), // Form action URL
            method: 'POST',
            data: formData,
            processData: false, // Important for file upload
            contentType: false, // Important for file upload
            success: function(response) {
                // Handle success (e.g., show a success message)
                alert('Product updated successfully!');
                // Optionally, redirect or update the page
                window.location.href = '/manager/products'; // Example redirect
            },
            error: function(xhr, status, error) {
                // Handle error (e.g., show an error message)
                alert('There was an error updating the product. Please try again.');
            }
        });
    });
});
</script>
@endsection
