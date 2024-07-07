<!-- resources/views/fleets/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Fleet</h1>
        <form action="{{ route('fleets.update', $fleet->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('fleets.partials.form', ['fleet' => $fleet])
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection

