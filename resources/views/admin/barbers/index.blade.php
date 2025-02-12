@extends('layouts.admin')

@section('title', 'Manage Barbers')

@section('content')
<h1>Manage Barbers</h1>
<a href="{{ route('admin.barbers.create') }}" class="btn btn-primary mb-4">Add New Barber</a>
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row">
    @foreach($barbers as $barber)
        <div class="col-md-4">
            <div class="card barber-card">
                <div class="card-overlay">
                    <h3 class="barber-name">{{ $barber->name }}</h3>
                    <p class="barber-bio">{{ $barber->bio }}</p>
                    <a href="{{ route('admin.barbers.edit', $barber->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form method="POST" action="{{ route('admin.barbers.destroy', $barber->id) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this barber?');">
                            Delete
                        </button>
                </div>
                <img src="{{ $barber->photo ? asset('storage/' . $barber->photo) : asset('images/default-image.jpg') }}" 
                     alt="{{ $barber->name }}" class="card-img">
                <div class="card-actions">
                
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
