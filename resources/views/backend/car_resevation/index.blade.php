<!-- resources/views/reservations/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Your Reservations</h1>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Car</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->id }}</td>
                        <td>{{ $reservation->car->brand }} {{ $reservation->car->model }}</td>
                        <td>{{ $reservation->start_date }}</td>
                        <td>{{ $reservation->end_date }}</td>
                        <td>{{ ucfirst($reservation->status) }}</td>
                        <td>
                            <a href="{{ route('reservations.show', $reservation->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
