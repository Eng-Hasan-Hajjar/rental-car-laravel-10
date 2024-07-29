@extends(Auth::user()->can('isEmployee') || Auth::user()->can('isAdmin') ? 'admin.layouts.layout' : 'admin.layouts.layoutvisitor')

@section('title')
التحكم
@endsection

@section('header')
    <!-- DataTables -->
    {{ Html::style('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}
    {{ Html::style('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}
@endsection

@section('content')
    <div class="container">
        <h1>Reservation Details</h1>
        <div>
            <strong>Car:</strong> {{ $reservation->car->brand }} {{ $reservation->car->model }}
        </div>
        <div>
            <strong>Start Date:</strong> {{ $reservation->start_date }}
        </div>
        <div>
            <strong>End Date:</strong> {{ $reservation->end_date }}
        </div>
        <div>
            <strong>Status:</strong> {{ ucfirst($reservation->status) }}
        </div>
        <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
@endsection
