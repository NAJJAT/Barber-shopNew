@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>My Bookings</h1>
    @if($bookings->isEmpty())
        <p>No bookings found.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Service</th>
                    <th>Barber</th>
                    <th>Appointment Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->service->name }}</td>
                        <td>{{ $booking->barber->name }}</td>
                        <td>{{ $booking->appointment_time }}</td>
                        <td>{{ $booking->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
