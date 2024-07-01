<!-- resources/views/garages/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Garage Details</h1>
        <div>
            <strong>Name:</strong> {{ $garage->name }}
        </div>
        <div>
            <strong>Location:</strong> {{ $garage->location }}
        </div>
        <div>
            <strong>Phone Number:</strong> {{ $garage->phone_number }}
        </div>
        <div>
            <strong>Working Hours:</strong> {{ $garage->working_hours }}
        </div>
    </div>
@endsection
