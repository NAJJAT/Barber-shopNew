<!-- resources/views/admin/bookings/edit.blade.php -->

@extends('layouts.admin')

@section('title', 'Edit Booking')

@section('content')
<h2>Edit Booking</h2>

<form method="POST" action="{{ route('admin.bookings.update', $booking) }}">
    @csrf
    @method('PUT')
    <div>
        <label for="status">Status:</label>
        <select name="status" required>
            <option value="confirmed" {{ $booking->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
            <option value="canceled" {{ $booking->status === 'canceled' ? 'selected' : '' }}>Canceled</option>
        </select>
    </div>
    <button type="submit">Update Booking</button>
</form>
@endsection
