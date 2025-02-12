<!-- resources/views/about.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>About Us</h1>
        <p>Welcome to our Barber Shop! We are dedicated to providing the best grooming services in town. Our skilled barbers have years of experience and are passionate about their craft.</p>
        <p>At our shop, we believe in quality service and customer satisfaction. Whether you need a haircut, shave, or styling, we’ve got you covered. Our comfortable atmosphere and friendly staff will make you feel right at home.</p>
        <h2>Our Mission</h2>
        <p>Our mission is to deliver exceptional grooming experiences that leave our customers looking and feeling their best.</p>
        <h2>Contact Information</h2>
        <p>If you have any questions or want to know more about our services, feel free to <a href="{{ route('contact.index') }}">contact us</a>.</p>
    </div>
@endsection
