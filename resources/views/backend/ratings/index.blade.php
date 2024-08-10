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
<a href="{{ route('dashboard') }}" class="btn btn-primary"> لوحة التحكم  </a>

    @include('backend.ratings.ratingtable')

@endsection

@section('footer')
    <!-- DataTables -->
    {{ Html::script('admin/plugins/datatables/jquery.dataTables.min.js') }}
    {{ Html::script('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}
    {{ Html::script('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}
    {{ Html::script('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}
@endsection
