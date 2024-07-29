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
        <h1>إنشاء الحجز من أجل السيارة : {{ $car->brand }} {{ $car->model }}</h1>
        <form action="{{ route('reservations.store', $car->id) }}" method="POST">
            @csrf
            @include('backend.car_reservation.partials.form')
            <button type="submit" class="btn btn-primary"> حفظ الحجز</button>
        </form>
    </div>
@endsection
