@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="card">
        <!-- News Image -->
        @if ($news->image_url)
            <img src="{{ asset('storage/' . $news->image_url) }}" class="card-img-top" alt="{{ $news->title }}">
        @endif

        <div class="card-body">
            <!-- News Title -->
            <h1 class="card-title">{{ $news->title }}</h1>

            <!-- News Content -->
            <p class="card-text">{{ $news->content }}</p>

            <!-- Published Date -->
            <p class="text-muted">
                Published: {{ $news->published_at ? \Carbon\Carbon::parse($news->published_at)->format('F j, Y') : 'Not published' }}
            </p>

            <div class="mt-4 d-flex justify-content-between">
                <!-- Edit Button -->
                <a href="{{ route('admin.news.edit', $news->id) }}" class="btn btn-warning">Edit</a>

                <!-- Delete Button -->
                <form method="POST" action="{{ route('admin.news.destroy', $news->id) }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Are you sure you want to delete this news item?');">
                        Delete
                    </button>
                </form>

                <!-- Back Button -->
                <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection
