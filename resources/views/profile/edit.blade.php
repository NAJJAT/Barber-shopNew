@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Edit Profile</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    
        <div class="form-group mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>
    
        <div class="form-group mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>
    
        <div class="form-group mb-3">
            <label for="bio" class="form-label">Bio</label>
            <textarea id="bio" name="bio" class="form-control" rows="5">{{ old('bio', $user->bio) }}</textarea>
        </div>
    
        <div class="form-group mb-3">
            <label for="birthday" class="form-label">Birthday</label>
            <input type="date" id="birthday" name="birthday" class="form-control" value="{{ old('birthday', $user->birthday) }}">
        </div>
    
        <div class="form-group mb-3">
            <label for="profile_photo" class="form-label">Profile Photo</label>
            <input type="file" id="profile_photo" name="profile_photo" class="form-control">
        </div>
    
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
    
</div>
@endsection
