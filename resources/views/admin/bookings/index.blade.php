@extends('layouts.admin')

@section('title', 'Manage Bookings')

@section('content')
<h2>Manage Bookings</h2>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<!-- Button to Add a New Booking -->
<div style="margin-bottom: 20px;">
    <a href="{{ route('admin.bookings.create') }}" class="btn btn-success">Add Booking</a>
</div>

<table>
    <thead>
        <tr>
            <th>Customer</th>
            <th>Service</th>
            <th>Barber</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($bookings as $booking)
            <tr>
                <td>{{ $booking->user->name }}</td> <!-- Display the customer name -->
                <td>{{ $booking->service->name }}</td>
                <td>{{ $booking->barber->name }}</td>
                <td>{{ $booking->date }}</td>
                <td>{{ $booking->time }}</td>
                <td>{{ ucfirst($booking->status) }}</td> <!-- Capitalize the status -->
                <td>
                    <a href="{{ route('admin.bookings.edit', $booking) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this booking?');">Cancel</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
