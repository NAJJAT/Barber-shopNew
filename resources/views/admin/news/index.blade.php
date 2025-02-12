@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Manage News</h1>
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary">Add News</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- News Cards -->
    <div class="row">
        @foreach($news as $item)
            <div class="col-md-4">
                <div class="card mb-4">
                    <!-- Display the uploaded image -->
                    @if ($item->image_url)
                        <img src="{{ asset('storage/' . $item->image_url) }}" class="card-img-top" alt="{{ $item->title }}">
                    @else
                        <p>No image available</p>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text">{{ Str::limit($item->content, 100) }}</p>
                        <p class="text-muted">
                            Published: {{ $item->published_at ? $item->published_at->format('F j, Y') : 'Not published' }}
                        </p>                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.news.show', $item->id) }}" class="btn btn-info btn-sm">Show</a>
                            <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form method="POST" action="{{ route('admin.news.destroy', $item->id) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this news item?');">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
