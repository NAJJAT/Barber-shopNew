@extends('layouts.app   ')

@section('title', 'User Dashboard')

@section('content')
<h2>User Dashboard</h2>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<h3>Your Bookings</h3>

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
        
    </tbody>
</table>
@endsection
