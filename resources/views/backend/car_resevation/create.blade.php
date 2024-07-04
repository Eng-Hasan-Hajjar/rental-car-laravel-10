<!-- resources/views/reservations/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Reservation for {{ $car->brand }} {{ $car->model }}</h1>
        <form action="{{ route('reservations.store', $car->id) }}" method="POST">
            @csrf
            @include('reservations.partials.form')
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
