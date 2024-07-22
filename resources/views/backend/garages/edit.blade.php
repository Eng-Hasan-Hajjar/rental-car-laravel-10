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
        <h1> التعديل  </h1>
        <form action="{{ route('garages.update', $garage->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('backend.garages.partials.form')
            <button type="submit" class="btn btn-primary"> تحديث </button>
        </form>
    </div>
@endsection
