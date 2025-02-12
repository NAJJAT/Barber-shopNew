@extends('layouts.admin')

@section('title', 'Edit Barber')

@section('content')
<h2>Edit Barber</h2>

<form action="{{ route('admin.barbers.update', $barber) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ $barber->name }}" required>
    </div>

    <div>
        <label for="photo">Photo:</label>
        <input type="file" id="photo" name="photo">
        <img src="{{ asset('storage/' . $barber->photo) }}" alt="{{ $barber->name }}" width="50">
    </div>

    <div>
        <label for="bio">Bio:</label>
        <textarea id="bio" name="bio">{{ $barber->bio }}</textarea>
    </div>

    <div>
        <label for="available">Available:</label>
        <input type="checkbox" id="available" name="available" value="1" {{ $barber->available ? 'checked' : '' }}>
    </div>

    <button type="submit">Update Barber</button>
</form>
@endsection
