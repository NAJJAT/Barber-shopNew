@extends('layouts.app')

@section('content')
<div class="container mt-4">
    

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
                    @if ($item->image_url)
                        <img src="{{ asset('storage/' . $item->image_url) }}" class="card-img-top" alt="{{ $item->title }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text">{{ Str::limit($item->content, 100) }}</p>
                        <p class="text-muted">Published: {{ $item->published_at->format('F j, Y') }}</p>
                        <div class="d-flex justify-content-between">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
