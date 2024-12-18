@extends('layouts.app')

@section('content')
<style>
    body {
        background: url('{{ asset('images/backg.jpg') }}') no-repeat center center fixed;
        background-size: cover;
    }

    .card {
        background-color: rgba(255, 255, 255, 0.2); /* Transparent white */
        backdrop-filter: blur(15px); /* Frosted glass effect */
        border: 1px solid rgba(255, 255, 255, 0.3); /* Soft white border */
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.3); /* Subtle shadow */
        border-radius: 15px; /* Rounded corners */
       
        
        margin-top: 100px;
        margin-left: 80px
    }
    .card:hover {
    background-color: rgba(255, 255, 255, 0.15); /* Slight change on hover */
    box-shadow: 0px 12px 30px rgba(0, 0, 0, 0.3); /* Enhanced shadow */
}

    .card-header {
        background-color: rgba(72, 73, 75, 0.5); /* Semi-transparent dark background */
        backdrop-filter: blur(10px); /* Subtle blur for header */
        color: white;
        font-weight: bold;
        text-align: center;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2); /* Separator line */
        margin-bottom: 20px
    }

    .form-control {
        background-color: rgba(255, 255, 255, 0.3); /* Input transparency */
        border: 1px solid rgba(255, 255, 255, 0.4); /* Soft white border */
        color: #000; /* Black text */
        backdrop-filter: blur(5px); /* Subtle blur for inputs */
    }

    .form-control:focus {
        background-color: rgba(255, 255, 255, 0.5); /* Slightly more opaque on focus */
        border: 1px solid rgba(72, 73, 75, 0.5); /* Focused border */
        box-shadow: none;
    }

    .btn-primary {
        background-color: rgba(0, 123, 255, 0.8); /* Semi-transparent blue */
        border-color: rgba(0, 123, 255, 0.8);
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-primary:hover {
        background-color: rgba(0, 86, 179, 0.8); /* Darker on hover */
        border-color: rgba(0, 86, 179, 0.8);
        transform: scale(1.05); /* Slight zoom effect */
    }

    .btn-primary:active {
        transform: scale(0.98); /* Pressed effect */
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
