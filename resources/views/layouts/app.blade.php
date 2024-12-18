<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

   
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
       
        .navbar {
            background: linear-gradient(135deg, rgba(29, 78, 216, 0.8), rgba(59, 130, 246, 0.8));
            backdrop-filter: blur(10px);
            z-index: 10;
           
        }

        .navbar img {
            height: 50px;
            width: 90px;
            
        }

        .nav-link {
            font-weight: 600;
            font-size: 1rem;
            color: #f7f3f3 !important;
            padding: 10px 15px;
            transition: color 0.3s;
            
        }

        .nav-link:hover {
            color: #fff !important;
            background: rgba(207, 201, 201, 0.2);
            border-radius: 5px;
        }

        .dropdown-menu {
            background: rgba(29, 78, 216, 0.9);
            border: none;
            border-radius: 5px;
            z-index: 9999;
            
        }

        .dropdown-menu .dropdown-item {
            color: #fff;
            transition: background 0.3s;
        }
        /* .custom-dropdown {
    width: 200px; 
} */


        .dropdown-menu .dropdown-item:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .fa-shopping-cart, .fa-bell {
            font-size: 1.5rem;
            color: white;
            position: relative;
        }
        .fa-envelope {
        font-size: 30px; /* Default size */
        transition: transform 0.3s ease; /* Smooth animation */
    }

    .fa-envelope:hover {
        transform: scale(1.5); /* Increases size by 1.5x */
    }
    .fa-bell{  font-size: 30px; /* Default size */
        transition: transform 0.3s ease;

    }
    .fa-bell:hover {
        transform: scale(1.5); /* Increases size by 1.5x */
    }

        .badge {
            position: absolute;
            top: -15px;
            right: -20px;
            font-size: 0.75rem;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 5px 8px;
        }

       
        @media (max-width: 767.98px) {
            .navbar {
                text-align: center;
            }

            .navbar-nav {
                flex-direction: column;
                align-items: center;
            }

            .navbar-toggler {
                border: none;
            }
        }




        
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-sm">
    <div class="container">
        <!-- Logo -->
        <a href="{{ route('home') }}">
            <img src="{{ asset('images/profile.png') }}" alt="Logo">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto"></ul>

            <ul class="navbar-nav ms-auto">
                @auth
                    @if (Auth::user()->hasRole('customer'))
                        <li class="nav-item">
                            <a href="{{ route('order.history') }}" class="nav-link">Your Orders</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('about') }}" class="nav-link">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('contact.show') }}" class="nav-link">Contact Us</a>
                        </li>
                        @elseif(Auth::User()->hasRole('manager'))
                        <li class="nav-item">
                            <a href="{{ route('manager.products.index') }}" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('manager.products.create') }}" class="nav-link">Add Product</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('manager.order.index') }}" class="nav-link">Orders</a>
                        </li>
                       
                    @endif
                @endauth

                @auth
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Hello, {{ ucfirst(Auth::user()->name) }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end ">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endauth

                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @endif
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endif
                @endguest
            </ul>

            <!-- Cart & Notifications -->
            @auth
            @if (Auth::user()->hasRole('customer'))
                <li class="nav-item nav-link">
                    <a href="{{ route('cart.view') }}" class="position-relative">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="badge text-dark" id="cart-count">{{ session('cart-count', 0) }}</span>
                    </a>
                </li>
            @elseif (Auth::user()->hasRole('manager'))
                <li class="nav-item nav-link">
                    <a href="#" class="position-relative" data-bs-toggle="modal" data-bs-target="#notificationsModal">
                        <i class="fa fa-bell"></i>
                        <span class="badge" id="notification-count">{{ auth()->user()->unreadNotifications->count() }}</span>
                    </a>
                </li>
                <li class="nav-item nav-link">
                    <a href="{{ route('manager.messages.view') }}" class="position-relative text-white"  >
                        <i class="fa fa-envelope"></i>
                        <span id="message-count" class="badge bg-danger">0</span>
                                            
                    </a>
                    
                </li>
            @endif
        @endauth
        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        
        <script>
             function updateNotificationCount() {
                $.ajax({
                    url: '{{ url('/unread-notifications-count') }}',
                    method: 'GET',
                    success: function(data) {
                        $('#notification-count').text(data.count);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching notification count:', error);
                    }
                });
            }
        
            setInterval(updateNotificationCount, 10000);
        </script>

        
        {{-- <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
        <script>
            Pusher.logToConsole = true;
            const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
                cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
                encrypted: true
            });
        
            const managerId = "{{ auth()->id() }}"; 
        
            const channel = pusher.subscribe('manager.messages.' + managerId);
        
            channel.bind('MessageSent', function(data) {
                document.getElementById('message-count').innerText = data.count;
            });
        
            
            fetchMessageCount();
        
            function fetchMessageCount() {
                fetch('{{ route('messages.count') }}')
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('message-count').innerText = data.count;
                    })
                    .catch(error => console.error('Error fetching message count:', error));
            }
        </script> --}}
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    // Enable logging for debugging (optional)
    Pusher.logToConsole = true;

    // Initialize Pusher
    const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
        encrypted: true
    });

    // Get the current manager ID
    const managerId = "{{ auth()->id() }}";

    // Subscribe to the Pusher channel for real-time updates
    const channel = pusher.subscribe('manager.messages.' + managerId);

    // Listen for the MessageSent event and update the message count dynamically
    channel.bind('MessageSent', function(data) {
        console.log("New message received:", data);
        updateMessageCount(data.count);
    });

    // Fetch the initial message count when the page loads
    fetchMessageCount();

    // Function to fetch the message count from the server
    function fetchMessageCount() {
        fetch('{{ route('messages.count') }}')
            .then(response => response.json())
            .then(data => {
                updateMessageCount(data.count);
            })
            .catch(error => console.error('Error fetching message count:', error));
    }

    // Function to update the message count in the DOM
    function updateMessageCount(count) {
        const messageCountElement = document.getElementById('message-count');
        messageCountElement.innerText = count;

        // Optionally hide the count badge if there are no messages
        if (count > 0) {
            messageCountElement.style.display = 'inline-block';
        } else {
            messageCountElement.style.display = 'none';
        }
    }
</script>

        
        
        </div>
    </div>
</nav>



<!-- Notification Modal -->
@auth
@if (Auth::user()->hasRole('manager'))
<div class="modal fade" id="notificationsModal" tabindex="-1" aria-labelledby="notificationsModalLabel" aria-hidden="true">
    <style>
        .modal-content {
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            background-color: #007bff;
            color: #fff;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .modal-title {
            font-size: 1.5rem;
        }

        .modal-body {
            background-color: #f8f9fa;
            padding: 20px;
            max-height: 500px;
            overflow-y: auto;
        }

        .list-group-item {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
            padding: 15px;
            background-color: #ffffff;
            transition: all 0.2s;
        }

        .list-group-item:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        .list-group-item h5 {
            font-size: 1.25rem;
            color: #0056b3;
            margin-bottom: 10px;
        }

        .list-group-item p {
            font-size: 1rem;
            color: #495057;
        }

        .list-group-item small {
            font-size: 0.85rem;
            color: #6c757d;
        }

        .btn-primary {
            background-color: #28a745;
            border: none;
        }

        .btn-primary:hover {
            background-color: #218838;
        }

        .btn-secondary {
            background-color: #17a2b8;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #138496;
        }

        .btn-close {
            background: transparent;
            border: none;
            font-size: 1.2rem;
        }

        .btn-close:hover {
            color: #ff0000;
        }
    </style>
{{-- modal code  --}}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationsModalLabel">
                    <i class="fas fa-bell me-2"></i>Notifications
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if (auth()->user()->unreadNotifications->count() === 0)
                <div class="text-center">
                        <p class="text-muted mb-4">
                            <i class="fas fa-bell-slash fa-2x mb-2"></i>
                            <br>No new notifications.
                        </p>
                        <a href="{{ route('manager.notifications') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-history me-2"></i>View All Read Notifications
                        </a>
                    </div>
                @else
                    <ul class="list-group">
                        @foreach (auth()->user()->unreadNotifications as $notification)
                            <li class="list-group-item">
                                <h5><i class="fas fa-box-open me-2"></i>Order ID: {{ $notification->data['order_id'] }}</h5>
                                <p>{{ $notification->data['message'] }}</p>
                                <p><strong>Total:</strong> ${{ number_format($notification->data['order_total'], 2) }}</p>
                                <p><strong>Customer:</strong> {{ $notification->data['customer_name'] }}</p>
                                <small>Sent {{ $notification->created_at->diffForHumans() }}</small>
                                <div class="d-flex justify-content-end mt-3">
                                    <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" class="me-2">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fas fa-check-circle me-1"></i>Mark as Read
                                        </button>
                                    </form>
                                    <a href="{{ route('manager.notifications') }}" class="btn btn-sm btn-secondary">
                                        <i class="fas fa-eye me-1"></i>View All
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>
@endif
@endauth


      

        <main class="">
            @yield('content')
        </main>
    </div>
   
</body>
</html>
