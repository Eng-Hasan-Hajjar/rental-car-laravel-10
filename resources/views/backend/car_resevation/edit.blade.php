<!-- resources/views/reservations/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Reservation</h1>
        <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('reservations.partials.form', ['reservation' => $reservation])
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection

