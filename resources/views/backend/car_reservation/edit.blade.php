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

        @if ($errors->any())
        <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
        </ul>
        </div>
        @endif

    <div class="container"style="direction: ltr;text-align:right;padding-top:0px;width:50%">
        <h1> التعديل للحجز</h1>
        <form action="{{ route('reservations.update', $reservation->id) }}" method="POST"style="direction: ltr;text-align:right;padding-top:0px;width:50%">
            @csrf
            @method('PUT')
            @include('backend.car_reservation.partials.form', ['reservation' => $reservation])
            <button type="submit" class="btn btn-primary"> تحديث </button>
            <a href="{{ route('dashboard') }}" class="btn btn-primary"> لوحة التحكم  </a>

        </form>
    </div>
@endsection

