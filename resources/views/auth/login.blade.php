<!-- resources/views/auth/login.blade.php -->
@extends('layouts.app')

@section('content')
<div class="wrapper">
    <div class="title"><span>Login Form</span></div>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email or Phone -->
        <div class="row">
            <i class="fas fa-user"></i>
            <input id="email" type="text" name="email" placeholder="Email or Phone" value="{{ old('email') }}" required autofocus autocomplete="username" />
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="row">
            <i class="fas fa-lock"></i>
            <input id="password" type="password" name="password" placeholder="Password" required autocomplete="current-password" />
            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Forgot Password -->
        <div class="pass">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">Forgot password?</a>
            @endif
        </div>

        <!-- Login Button -->
        <div class="row button">
            <input type="submit" value="Login" />
        </div>

        <!-- Signup Link -->
        <div class="signup-link">
            Not a member? <a href="{{ route('register') }}">Signup now</a>
        </div>
    </form>
</div>
@endsection
