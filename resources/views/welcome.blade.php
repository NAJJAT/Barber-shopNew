@extends('layouts.app')


@section('content')
<div class="welcome-container">
    <h1>Welcome to Our Barber Shop!</h1>
    <p>Experience top-notch grooming services by our skilled barbers.</p>
    <p>Book your appointment today and look your best!</p>
    
    <h2>Our Services</h2>
    <ul>
        <li>Haircuts</li>
        <li>Shaves</li>
        <li>Beard Trims</li>
        <li>Coloring</li>
    </ul>
    
    <h2>Why Choose Us?</h2>
    <ul>
        <li>Professional Barbers</li>
        <li>Comfortable Environment</li>
        <li>Quality Products</li>
        <li>Affordable Prices</li>
    </ul>

    <a href="" class="btn">Book Now</a>
</div>
@auth
    @if(auth()->user()->isAdmin())
        <!-- Alleen zichtbaar voor admin -->
        <li><a href="{{ route('admin.faqs.index') }}">Manage FAQs</a></li>
    @elseif(auth()->user()->isUser())
        <!-- Alleen zichtbaar voor gewone gebruikers -->
        <li><a href="{{ route('user.faqs.index') }}">My FAQs</a></li>
        <li><a href="{{ route('faqs.public') }}">View FAQs</a></li>
    @endif
@endauth

    
@endsection
