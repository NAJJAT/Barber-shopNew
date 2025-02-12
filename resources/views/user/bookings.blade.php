@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Your Bookings</h1> <!-- Change this from Your Appointments to Your Bookings -->

        @if($bookings->isEmpty())
            <p>You have no bookings scheduled.</p> <!-- Change this from appointments to bookings -->
        @else
            <ul>
                @foreach($bookings as $booking) <!-- Assuming you have a collection of bookings -->
                    <li>
                        <a href="{{ route('user.bookings.show', $booking->id) }}">{{ $booking->description }}</a> <!-- Pass the booking ID here -->
                    </li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('bookings.store') }}" method="POST"> <!-- Ensure this route is correct -->
            @csrf
            <div>
                <label for="booking_date">Booking Date:</label>
                <input type="datetime-local" name="booking_date" required>
            </div>
            <div>
                <label for="description">Description:</label>
                <input type="text" name="description">
            </div>
            <button type="submit">Create Booking</button> <!-- Change this from Create Appointment to Create Booking -->
        </form>
    </div>
@endsection
