<!-- resources/views/maintenances/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Maintenances for {{ $car->brand }} {{ $car->model }}</h1>
        <a href="{{ route('maintenances.create', $car->id) }}" class="btn btn-primary">Add New Maintenance</a>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Details</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($maintenances as $maintenance)
                    <tr>
                        <td>{{ $maintenance->id }}</td>
                        <td>{{ $maintenance->date }}</td>
                        <td>{{ $maintenance->details }}</td>
                        <td>
                            <a href="{{ route('maintenances.edit', [$car->id, $maintenance->id]) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('maintenances.destroy', [$car->id, $maintenance->id]) }}" method="POST" style="display:inline-block;">
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
