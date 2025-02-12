@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mt-4">Edit FAQ</h2>

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

    <!-- FAQ Edit Form -->
    <form method="POST" action="{{ route('admin.faqs.update', $faq->id) }}" class="mt-4">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="category" class="form-label">Category</label>
            <select id="category" name="faq_category_id" class="form-control" required>
                <option value="" disabled>Select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $faq->faq_category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="question" class="form-label">Question</label>
            <input type="text" id="question" name="question" class="form-control" value="{{ $faq->question }}" placeholder="Enter the FAQ question" required>
        </div>

        <div class="form-group mb-3">
            <label for="answer" class="form-label">Answer</label>
            <textarea id="answer" name="answer" class="form-control" rows="5" placeholder="Enter the FAQ answer" required>{{ $faq->answer }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update FAQ</button>
        <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
