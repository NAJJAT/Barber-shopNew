<!-- resources/views/admin/dashboard.blade.php -->

@extends('layouts.admin')

@section('content')
    <p>Welcome to the admin dashboard. Use the links below to manage the application.</p>

    <div class="dashboard-links">
        <div class="dashboard-card">
            <a href="{{ route('admin.services.index') }}">
                <h2>Manage Services</h2>
                <p>View and update available services.</p>
            </a>
        </div>
        <div class="dashboard-card">
            <a href="{{ route('admin.barbers.index') }}">
                <h2>Manage Barbers</h2>
                <p>View, add, or edit barber information.</p>
            </a>
        </div>
        <div class="dashboard-card">
            <a href="{{ route('admin.bookings.index') }}">
                <h2>Manage Bookings</h2>
                <p>View and update customer appointments.</p>
            </a>
        </div>
    </div>
@endsection
