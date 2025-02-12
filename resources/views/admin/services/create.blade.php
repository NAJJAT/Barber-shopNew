<!-- resources/views/admin/services/create.blade.php -->

@extends('layouts.admin')

@section('title', 'Add Service')

@section('content')
<h2>Add Service</h2>

<form method="POST" action="{{ route('admin.services.store') }}">
    @csrf
    <div>
        <label for="name">Service Name:</label>
        <input type="text" name="name" required>
    </div>
    <div>
        <label for="description">Description:</label>
        <textarea name="description"></textarea>
    </div>
    <div>
        <label for="price">Price:</label>
        <input type="number" name="price" required>
    </div>
    <button type="submit">Add Service</button>
</form>
@endsection
