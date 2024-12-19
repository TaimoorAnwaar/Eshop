@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<div class="container py-5">
    <!-- Page Header -->
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold text-primary">Get in Touch</h1>
        <p class="lead text-muted">We’d love to hear from you! Fill out the form below or reach us via our contact details.</p>
    </div>

    <div class="d-flex justify-content-center align-items-center cardsRow">
        <!-- Contact Form -->
        <div class="col-md-6 mb-4 mb-md-0">
            <div class="card shadow-lg border-light rounded-lg">
                <div class="card-body">
                    <h5 class="card-title text-primary fw-bold text-center">Send Us a Message</h5>
                    <form action="{{ route('contact.submit') }}" method="POST" id="contact-form">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Your Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Your Message</label>
                            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Enter your message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Send Message</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="col-md-4 mx-5 ">
            <div class="card shadow-lg border-light rounded-lg">
                <div class="card-body">
                    <h5 class="card-title text-primary fw-bold text-center">Our Contact Details</h5>
                    <p class="card-text ">
                        <strong>Email:</strong> E-shop@gamail.com<br>
                        <strong>Phone:</strong> +92 (316) 4201521 <br>
                        <strong>Address:</strong> 123 DHA Raya Phase 6<br>Lahore, Punjab, 54000
                    </p>
                    <h6 class="mt-4 text-primary fw-bold text-center">Follow Us</h6>
                    <p class="text-center">
                        <a href="#" class="me-3"><i class="bi bi-facebook text-primary " style="font-size: 1.8rem;"></i></a>
                        <a href="#" class="me-3"><i class="bi bi-twitter text-primary" style="font-size: 1.8rem;"></i></a>
                        <a href="#"><i class="bi bi-instagram text-primary" style="font-size: 1.8rem;"></i></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        $('#contact-form').on('submit', function (e) {
            e.preventDefault();

            let formData = {
                _token: '{{ csrf_token() }}',
                name: $('#name').val(),
                email: $('#email').val(),
                message: $('#message').val()
            };

            $.ajax({
                url: '{{ route("contact.submit") }}',
                type: 'POST',
                data: formData,
                success: function (response) {
                    Swal.fire({
                        title: 'Success',
                        text: 'Message sent successfully!',
                        icon: 'success',
                        confirmButtonColor: '#4CAF50',
                    });
                    $('#contact-form')[0].reset();
                },
                error: function (xhr) {
                    Swal.fire({
                        title: 'Error',
                        text: 'Failed to send the message. Please try again.',
                        icon: 'error',
                        confirmButtonColor: '#FF0000',
                    });
                }
            });
        });
    });
</script>




<style>
    
    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        font-size: 1.75rem;
        margin-bottom: 1.5rem;
        font-weight: 700;
    }

    .btn-primary {
        padding: 12px 20px;
        font-size: 1.1rem;
        border-radius: 10px;
        transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #004494;
        transform: translateY(-3px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

   
    .card-body i {
        transition: transform 0.3s ease, color 0.3s ease;
    }

    .card-body i:hover {
        color: #004494;
        transform: scale(1.2);
    }

    
    .container {
        padding-left: 20px;
        padding-right: 20px;
    }

    
    @media (max-width: 768px) {
        .container {
            padding-left: 15px;
            padding-right: 15px;
        }
        .cardsRow{
            flex-direction: column
        }
    }

    
    .text-primary {
        color: #0062cc !important;
    }

    .text-muted {
        color: #6c757d !important;
    }

</style>

@endsection
