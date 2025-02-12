<!-- resources/views/admin/services/edit.blade.php -->

@extends('layouts.admin')

@section('title', 'Edit Service')

@section('content')
<h2>Edit Service</h2>

<form method="POST" action="{{ route('admin.services.update', $service) }}">
    @csrf
    @method('PUT')
    <div>
        <label for="name">Service Name:</label>
        <input type="text" name="name" value="{{ $service->name }}" required>
    </div>
    <div>
        <label for="description">Description:</label>
        <textarea name="description">{{ $service->description }}</textarea>
    </div>
    <div>
        <label for="price">Price:</label>
        <input type="number" name="price" value="{{ $service->price }}" required>
    </div>
    <button type="submit">Update Service</button>
</form>
@endsection
