<!-- resources/views/maintenances/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add Maintenance for {{ $car->brand }} {{ $car->model }}</h1>
        <form action="{{ route('maintenances.store', $car->id) }}" method="POST">
            @csrf
            @include('maintenances.partials.form')
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
