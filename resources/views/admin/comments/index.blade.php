@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Manage Comments</h1>
        <!-- Add New Comment Button -->
        <a href="{{ route('admin.comments.create') }}" class="btn btn-primary btn-lg">Add New Comment</a>
    </div>

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

    <!-- Comments Table -->
    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>#</th>
                <th>FAQ Category</th>
                <th>Comment</th>
                <th>User</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td>{{ $comment->id }}</td>
                    <td>{{ $comment->category->name ?? 'No Category' }}</td> <!-- FAQ Category -->
                    <td>{{ $comment->comment }}</td>
                    <td>{{ $comment->user->name ?? 'Anonymous' }}</td> <!-- User Name -->
                    <td>
                        <!-- Edit Comment -->
                        <a href="{{ route('admin.comments.edit', $comment->id) }}" class="btn btn-secondary btn-sm">Edit</a>

                        <!-- Delete Comment -->
                        <form method="POST" action="{{ route('admin.comments.destroy', $comment->id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this comment?');">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
