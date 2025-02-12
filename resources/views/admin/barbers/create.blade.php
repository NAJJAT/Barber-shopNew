@extends('layouts.admin')

@section('title', 'Add New Barber')

@section('content')
<h2>Add New Barber</h2>

<!-- Form for adding a new barber -->
<form action="{{ route('admin.barbers.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
    </div>

    <div>
        <label for="photo">Photo:</label>
        <input type="file" id="photo" name="photo">
    </div>

    <div>
        <label for="bio">Bio:</label>
        <textarea id="bio" name="bio"></textarea>
    </div>

    <div>
        <label for="available">Available:</label>
        <input type="checkbox" id="available" name="available" value="1">
    </div>

    <button type="submit">Add Barber</button>
</form>
@endsection
