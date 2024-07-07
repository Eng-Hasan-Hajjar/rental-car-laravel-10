<!-- resources/views/fleets/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Fleet Management</h1>
        <a href="{{ route('fleets.create') }}" class="btn btn-primary">Add New Fleet</a>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fleets as $fleet)
                    <tr>
                        <td>{{ $fleet->id }}</td>
                        <td>{{ $fleet->name }}</td>
                        <td>{{ $fleet->location }}</td>
                        <td>{{ $fleet->description }}</td>
                        <td>
                            <a href="{{ route('fleets.show', $fleet->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('fleets.edit', $fleet->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('fleets.destroy', $fleet->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

