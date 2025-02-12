@extends('layouts.admin')

@section('content')
<h2 class="faq-heading">Manage All FAQs</h2>
<a href="{{ route('admin.faqs.create') }}" class="add-faq-btn">Add New FAQ</a>

<table class="faq-table">
    <thead>
        <tr>
            <th>Question</th>
            <th>Answer</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($faqs as $faq)
            <tr>
                <td>{{ $faq->question }}</td>
                <td>{{ $faq->answer }}</td>
                <td>
                    <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="edit-btn">Edit</a>
                    <form method="POST" action="{{ route('admin.faqs.destroy', $faq->id) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
