@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Meet Our Barbers</h1>

    @if($barbers->isEmpty())
        <div class="alert alert-info text-center">
            <p>No barbers are currently available. Please check back later.</p>
        </div>
    @else
        <div class="row">
            @foreach($barbers as $barber)
                <div class="col-md-4">
                    <div class="card barber-card mb-4 shadow-sm">
                        @if($barber->photo)
                            <img src="{{ asset('storage/' . $barber->photo) }}" alt="{{ $barber->name }}" class="card-img-top barber-photo">
                        @else
                            <img src="{{ asset('images/default-barber.png') }}" alt="Default Barber" class="card-img-top barber-photo">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $barber->name }}</h5>
                            <p class="card-text">{{ $barber->bio }}</p>
                            <p class="card-text"><strong>Experience:</strong> {{ $barber->experience }} years</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection