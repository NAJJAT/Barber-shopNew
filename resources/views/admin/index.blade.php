<!-- resources/views/admin/bookings/index.blade.php -->

@extends('layouts.admin')

@section('title', 'Manage Bookings')

@section('content')
<h2>Manage Bookings</h2>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table>
    <thead>
        <tr>
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
                <td>{{ $booking->service->name }}</td>
                <td>{{ $booking->barber->name }}</td>
                <td>{{ $booking->date }}</td>
                <td>{{ $booking->time }}</td>
                <td>{{ $booking->status }}</td>
                <td>
                    <a href="{{ route('admin.bookings.edit', $booking) }}">Edit</a>
                    <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Cancel</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
