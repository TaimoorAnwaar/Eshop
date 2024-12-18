@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <h2 class="text-center text-primary mb-4">Admin Dashboard</h2>
    <h4 class="text-center mb-4">List of Users</h4>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-hover shadow-lg rounded-3">
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Assign Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ ucfirst( $user->name) }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->role) }}</td> <!-- Capitalize role -->
                        <td>
                            <form action="{{ route('admin.assignRole', $user->id) }}" method="POST">
                                @csrf
                                <select name="role" class="form-control form-control-sm">
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="manager" {{ $user->role == 'manager' ? 'selected' : '' }}>Manager</option>
                                    <option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>Customer</option>
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm mt-2">Assign Role</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
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
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
        
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
        color: #2a3036;
    }
</style>
@endsection
