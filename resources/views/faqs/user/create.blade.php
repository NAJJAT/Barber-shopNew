@extends('layouts.app')

@section('title', 'Create New FAQ')

@section('content')
<div class="container">
    <h1 class="my-4">Create New FAQ</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('user.faqs.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="faq_category_id">Category</label>
            <select name="faq_category_id" id="faq_category_id" class="form-control" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="question">Question</label>
            <input type="text" name="question" id="question" class="form-control" value="{{ old('question') }}" required>
        </div>

        <div class="form-group">
            <label for="answer">Answer</label>
            <textarea name="answer" id="answer" rows="5" class="form-control" required>{{ old('answer') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Create FAQ</button>
        <a href="{{ route('user.faqs.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
