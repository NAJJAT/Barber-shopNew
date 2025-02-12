@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Edit Comment</h1>

    <!-- Display Success or Error Messages -->
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

    <!-- Edit Comment Form -->
    <form method="POST" action="{{ route('admin.comments.update', $comment->id) }}">
        @csrf
        @method('PUT') <!-- This is required for PUT requests -->
        <div class="form-group mb-3">
            <label for="comment" class="form-label">Comment</label>
            <textarea 
                id="comment" 
                name="comment" 
                class="form-control" 
                rows="5" 
                placeholder="Edit your comment..." 
                required>{{ old('comment', $comment->comment) }}</textarea>
        </div>
    
        <div class="d-flex justify-content-start">
            <button type="submit" class="btn btn-primary">Update comment
            </button>
            <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
     
</div>
@endsection
