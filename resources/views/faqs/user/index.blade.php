@extends('layouts.app')

@section('title', 'My FAQs')

@section('content')
<div class="container">
    <h1 class="my-4">My FAQs</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($faqs->isEmpty())
        <div class="alert alert-info">
            You haven't added any FAQs yet.
        </div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($faqs as $faq)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $faq->category->name ?? 'Uncategorized' }}</td>
                        <td>{{ $faq->question }}</td>
                        <td>{{ Str::limit($faq->answer, 50) }}</td>
                        <td>
                            <a href="{{ route('user.faqs.edit', $faq->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('user.faqs.destroy', $faq->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this FAQ?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('user.faqs.create') }}" class="btn btn-success">Add New FAQ</a>
</div>
@endsection
