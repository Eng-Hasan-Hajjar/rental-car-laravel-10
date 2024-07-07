<!-- resources/views/fleets/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New Fleet</h1>
        <form action="{{ route('fleets.store') }}" method="POST">
            @csrf
            @include('fleets.partials.form')
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
