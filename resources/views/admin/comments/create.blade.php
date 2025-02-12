@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Create a New Comment</h1>

    <!-- Success or Error Messages -->
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

    <!-- Create Comment Form -->
    <form method="POST" action="{{ route('admin.comments.store') }}">
        @csrf

        <!-- Category Dropdown -->
        <div class="form-group mb-3">
            <label for="faq_category_id" class="form-label">Category</label>
            <select id="faq_category_id" name="faq_category_id" class="form-control" required>
                <option value="" disabled selected>Select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- User Input -->
        <div class="form-group mb-3">
            <label for="user_id" class="form-label">User</label>
            <input type="number" id="user_id" name="user_id" class="form-control" placeholder="Enter user ID" required>
        </div>

        <!-- Comment -->
        <div class="form-group mb-3">
            <label for="comment" class="form-label">Comment</label>
            <textarea id="comment" name="comment" class="form-control" rows="5" placeholder="Write your comment..." required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Create Comment</button>
        <a href="{{ route('admin.comments.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
