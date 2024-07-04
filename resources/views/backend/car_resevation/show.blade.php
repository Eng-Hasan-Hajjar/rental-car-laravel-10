<!-- resources/views/reservations/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Reservation Details</h1>
        <div>
            <strong>Car:</strong> {{ $reservation->car->brand }} {{ $reservation->car->model }}
        </div>
        <div>
            <strong>Start Date:</strong> {{ $reservation->start_date }}
        </div>
        <div>
            <strong>End Date:</strong> {{ $reservation->end_date }}
        </div>
        <div>
            <strong>Status:</strong> {{ ucfirst($reservation->status) }}
        </div>
        <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
@endsection
