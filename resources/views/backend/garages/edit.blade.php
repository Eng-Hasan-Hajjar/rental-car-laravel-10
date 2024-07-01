<!-- resources/views/garages/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Garage</h1>
        <form action="{{ route('garages.update', $garage->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('garages.partials.form')
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
