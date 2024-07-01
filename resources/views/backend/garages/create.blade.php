<!-- resources/views/garages/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add New Garage</h1>
        <form action="{{ route('garages.store') }}" method="POST">
            @csrf
            @include('garages.partials.form')
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
