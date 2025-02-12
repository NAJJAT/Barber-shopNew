
@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Add New User</h1>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
        @csrf
    
        <!-- Name -->
        <div class="form-group mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Enter full name" required>
        </div>
    
        <!-- Email -->
        <div class="form-group mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Enter email address" required>
        </div>
    
        <!-- Password -->
        <div class="form-group mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" required>
        </div>
    
        <!-- Confirm Password -->
        <div class="form-group mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Re-enter password" required>
        </div>
    
        <!-- Role -->
        <div class="form-group mb-3">
            <label for="role" class="form-label">Role</label>
            <select id="role" name="role" class="form-control">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>
    
        <!-- Bio -->
        <div class="form-group mb-3">
            <label for="bio" class="form-label">Bio</label>
            <textarea id="bio" name="bio" class="form-control" rows="5" placeholder="Enter a short bio"></textarea>
        </div>
    
        <!-- Birthday -->
        <div class="form-group mb-3">
            <label for="birthday" class="form-label">Birthday</label>
            <input type="date" id="birthday" name="birthday" class="form-control">
        </div>
    
        <!-- Profile Photo -->
        <div class="form-group mb-3">
            <label for="profile_photo" class="form-label">Profile Photo</label>
            <input type="file" id="profile_photo" name="profile_photo" class="form-control">
        </div>
    
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Add User</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
    
</div>
@endsection
