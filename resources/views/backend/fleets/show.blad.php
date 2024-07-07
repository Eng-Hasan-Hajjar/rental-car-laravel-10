<!-- resources/views/fleets/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Fleet Details</h1>
        <div>
            <strong>Name:</strong> {{ $fleet->name }}
        </div>
        <div>
            <strong>Location:</strong> {{ $fleet->location }}
        </div>
        <div>
            <strong>Description:</strong> {{ $fleet->description }}
        </div>
        <a href="{{ route('fleets.edit', $fleet->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('fleets.destroy', $fleet->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
@endsection
