@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<div class="container py-5">
    <!-- Hero Section -->
    <div class="row align-items-center mb-5">
        <div class="col-md-6">
            <img src="{{ asset('images/downloads.jpg') }}" alt="About Us" class=" img-fluid " style="height:400px;  object-fit: cover;">
        </div>
        <div class="col-md-6">
            <h1 class="display-4 fw-bold text-primary mb-4">Who We Are</h1>
            <p class="lead text-muted">
                Welcome to <strong style="font-weight: 700">E-shop</strong>, your go-to destination for premium products. We take pride in delivering quality and excellence with every product you purchase.
            </p>
            <p>
                Founded in <strong>[2015]</strong>, our mission is to bring you an exceptional online shopping experience, offering a wide range of products tailored to your needs. Customer satisfaction is at the heart of everything we do.
            </p>
        </div>
    </div>

    <hr class="my-5">

    <!-- Three Pillars Section (Cards) -->
    <div class="row text-center">
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <i class="bi bi-box-seam display-3 text-primary mb-4"></i>
                    <h5 class="card-title">High-Quality Products</h5>
                    <p class="card-text text-muted">Our products are carefully selected to ensure durability, style, and value for your money.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <i class="bi bi-people display-3 text-primary mb-4"></i>
                    <h5 class="card-title">Customer-Centric</h5>
                    <p class="card-text text-muted">We prioritize our customers, offering exceptional support and personalized shopping experiences.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <i class="bi bi-globe display-3 text-primary mb-4"></i>
                    <h5 class="card-title">Global Reach</h5>
                    <p class="card-text text-muted">We deliver to customers around the world with fast and reliable shipping options.</p>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-5">

    <!-- Our Story Section -->
    <div class="row align-items-center">
        <div class="col-md-6 order-md-2">
            <img src="{{ asset('images/backg.jpg') }}" alt="Our Story" class="img-fluid rounded shadow" style="object-fit: cover; height: 400px;">
        </div>
        <div class="col-md-6">
            <h2 class="fw-bold text-primary mb-4">Our Story</h2>
            <p>
                What started as a small passion project has grown into a trusted eCommerce platform for thousands of happy customers. At <strong>E-shop</strong>, we are committed to making shopping easy and enjoyable.
            </p>
            <p>
                From humble beginnings to becoming a global brand, our journey is a testament to the trust and loyalty of our customers. Join us as we continue to innovate and bring the best to your doorstep.
            </p>
        </div>
    </div>

    <!-- Call-to-Action Section -->
    <div class="text-center mt-5">
        <a href="{{ route('home') }}" class="btn btn-primary btn-lg shadow-sm">
            <i class="bi bi-cart-plus me-2"></i> Start Shopping
        </a>
    </div>


   
    





<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa; 
        color: #333;
    }

    .container {
        max-width: 1200px;
    }

    img.img-fluid {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h1.display-4, h2.fw-bold {
        color: #0056b3;
    }

    p.lead {
        font-size: 1.25rem;
        line-height: 1.8;
        color: #555; 
    }

    .card {
        border: none; 
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background-color: #fff; 
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    }

    .card-body {
        padding: 20px;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: bold;
        color: #0056b3;
    }

    .card-text {
        color: #666; 
    }

    .card-body i {
        font-size: 3rem;
        color: #0056b3;
        margin-bottom: 15px;
    }

    .btn-primary {
        background-color: #0056b3;
        border-color: #0056b3;
        padding: 15px 30px;
        font-size: 1.2rem;
        border-radius: 5px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #004494;
        transform: translateY(-3px);
    }

    img[alt="Our Story"] {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h2.fw-bold {
        margin-bottom: 20px;
    }

    hr {
        border: 0;
        height: 1px;
        background: #ddd;
        margin: 40px 0;
    }

    .modal-body textarea {
        height: 150px;
    }

    @media (max-width: 768px) {
        h1.display-4, h2.fw-bold {
            font-size: 2rem;
        }

        p.lead {
            font-size: 1rem;
        }

        .card-body i {
            font-size: 2.5rem;
        }
    }
</style>


@endsection
