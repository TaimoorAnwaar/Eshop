@extends('layouts.app')

@section('title', 'Add Product')

@section('content')
<h1 class="text-center my-4 text-primary">Add New Product</h1>

<form action="{{ route('manager.products.store') }}" method="POST" enctype="multipart/form-data" class="mx-auto" style="max-width: 600px;">
    @csrf
    <div class="form-group mb-4">
        <label for="name" class="font-weight-bold text-dark">Product Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required placeholder="Enter product name">
    </div>
    <div class="form-group mb-4">
        <label for="price" class="font-weight-bold text-dark">Price ($)</label>
        <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}" required placeholder="Enter price">
    </div>
    <div class="form-group mb-4">
        <label for="stock" class="font-weight-bold text-dark">Stock</label>
        <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock') }}" required placeholder="Enter stock quantity">
    </div>
    <div class="form-group mb-4">
        <label for="description" class="font-weight-bold text-dark">Description</label>
        <textarea name="description" id="description" class="form-control" placeholder="Enter product description">{{ old('description') }}</textarea>
    </div>
    <div class="form-group mb-4">
        <label for="image" class="font-weight-bold text-dark">Product Image</label>
        <input type="file" name="image" id="image" class="form-control">
    </div>
    <button type="submit" class="btn btn-success btn-block py-2 mt-3">Add Product</button>
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
    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
        font-size: 16px;
        font-weight: 600;
        padding: 12px;
        transition: all 0.3s ease;
        border-radius: 5px;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
        transform: translateY(-2px);
    }

    .btn-success:active {
        transform: translateY(1px);
    }
</style>
@endsection
