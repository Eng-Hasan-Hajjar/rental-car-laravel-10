<!-- resources/views/ratings/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add Rating for {{ $car->brand }} {{ $car->model }}</h1>
        <form action="{{ route('ratings.store', $car->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="rating">Rating</label>
                <select class="form-control" id="rating" name="rating" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div class="form-group">
                <label for="comment">Comment</label>
                <textarea class="form-control" id="comment" name="comment"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
