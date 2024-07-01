<!-- resources/views/maintenances/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Maintenance for {{ $car->brand }} {{ $car->model }}</h1>
        <form action="{{ route('maintenances.update', [$car->id, $maintenance->id]) }}" method="POST">
            @csrf
            @method('PUT')
            @include('maintenances.partials.form')
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
