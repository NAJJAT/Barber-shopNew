@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="text-center">
        <img src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : asset('default-profile.png') }}" 
     alt="Profile Photo" 
     class="rounded-circle mb-3" 
     width="150">
        <!-- Profile Details -->
        <h1>{{ $user->name }}</h1>
        <p>{{ $user->bio ?? 'No bio provided.' }}</p>
        <p><strong>Birthday:</strong> {{ $user->birthday ? $user->birthday->format('F j, Y') : 'Not provided' }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>

        <!-- Edit Profile Button -->
        @if(auth()->id() === $user->id)
            <a href="{{ route('profile.edit') }}" class="btn btn-primary mt-3">Edit Profile</a>
        @endif
    </div>
</div>
@endsection

