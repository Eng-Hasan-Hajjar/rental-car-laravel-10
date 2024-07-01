<!-- resources/views/cars/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Car Details</h1>
        <div>
            <strong>Brand:</strong> {{ $car->brand }}
        </div>
        <div>
            <strong>Model:</strong> {{ $car->model }}
        </div>
        <div>
            <strong>Year:</strong> {{ $car->year }}
        </div>
        <div>
            <strong>Color:</strong> {{ $car->color }}
        </div>
        <div>
            <strong>Seats:</strong> {{ $car->seats }}
        </div>
        <div>
            <strong>Daily Rate:</strong> ${{ $car->daily_rate }}
        </div>
        <div>
            <strong>Status:</strong> {{ $car->status }}
        </div>
        <div>
            <strong>Description:</strong> {{ $car->description }}
        </div>
        @if ($car->image)
            <div>
                <strong>Image:</strong> <img src="{{ Storage::url($car->image) }}" alt="{{ $car->model }}" style="width: 200px;">
            </div>
        @endif

        <h2>Ratings</h2>
        @foreach($car->ratings as $rating)
            <div>
                <strong>User:</strong> {{ $rating->user->name }}
            </div>
            <div>
                <strong>Rating:</strong> {{ $rating->rating }}
            </div>
            <div>
                <strong>Comment:</strong> {{ $rating->comment }}
            </div>
            <hr>
        @endforeach
    </div>
@endsection
