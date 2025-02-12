@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Edit News</h1>

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

    <!-- Edit News Form -->
    <form method="POST" action="{{ route('admin.news.update', $news->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div class="form-group mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $news->title) }}" required>
        </div>

        <!-- Content -->
        <div class="form-group mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea id="content" name="content" class="form-control" rows="5" required>{{ old('content', $news->content) }}</textarea>
        </div>

        <!-- Image -->
        <div class="form-group mb-3">
            <label for="image" class="form-label">Image (optional)</label>
            <input type="file" id="image" name="image" class="form-control">
            @if ($news->image_url)
                <small>Current Image: <a href="{{ asset('storage/' . $news->image_url) }}" target="_blank">View</a></small>
            @endif
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update News</button>
        <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
