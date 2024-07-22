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
<div class="container mt-5" style="align-items: center;text-align:center; direction:rtl">
    <div class="card"style=" text-align: center;">
        <div class="card-header bg-primary text-white" style=" text-align: center;">
            <h1 class="card-title card-text"style=" text-align: center;">التفاصيل</h1>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <strong>الاسم :</strong> <span class="card-text">{{ $garage->name }}</span>
            </div>
            <div class="mb-3">
                <strong>الموقع :</strong> <span class="card-text">{{ $garage->location }}</span>
            </div>
            <div class="mb-3">
                <strong>رقم الهاتف :</strong> <span class="card-text">{{ $garage->phone_number }}</span>
            </div>
            <div class="mb-3">
                <strong>ساعات العمل :</strong> <span class="card-text">{{ $garage->working_hours }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
