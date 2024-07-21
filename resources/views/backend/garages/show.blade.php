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
