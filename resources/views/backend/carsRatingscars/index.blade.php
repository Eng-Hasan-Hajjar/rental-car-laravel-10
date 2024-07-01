 <!-- resources/views/ratings/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Ratings for {{ $car->brand }} {{ $car->model }}</h1>
        <a href="{{ route('ratings.create', $car->id) }}" class="btn btn-primary">Add New Rating</a>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Rating</th>
                    <th>Comment</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ratings as $rating)
                    <tr>
                        <td>{{ $rating->id }}</td>
                        <td>{{ $rating->user->name }}</td>
                        <td>{{ $rating->rating }}</td>
                        <td>{{ $rating->comment }}</td>
                        <td>{{ $rating->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
