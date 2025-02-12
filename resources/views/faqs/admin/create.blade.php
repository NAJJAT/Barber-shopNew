@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Create a New FAQ</h2>

    <!-- Display success or error messages -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- FAQ Creation Form -->
    <form method="POST" action="{{ route('admin.faqs.store') }}">
        @csrf

        <div class="form-group">
            <label for="category">Category</label>
            <select id="category" name="faq_category_id" class="form-control" required>
                <option value="" disabled selected>Select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="question">Question</label>
            <input type="text" id="question" name="question" class="form-control" placeholder="Enter the question" required>
        </div>

        <div class="form-group">
            <label for="answer">Answer</label>
            <textarea id="answer" name="answer" class="form-control" rows="5" placeholder="Enter the answer" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Create FAQ</button>
    </form>
</div>
@endsection
