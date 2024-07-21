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
        <h1> الصيانات </h1>
        <a href="{{ route('maintenances.create') }}" class="btn btn-primary"> انشاء جديد </a>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>الرقم </th>
                    <th> التاريخ </th>
                    <th>التفاصيل </th>
                    <th> التحكم </th>
                </tr>
            </thead>
            <tbody>
                @foreach($maintenances as $maintenance)
                    <tr>
                        <td>{{ $maintenance->id }}</td>
                        <td>{{ $maintenance->date }}</td>
                        <td>{{ $maintenance->details }}</td>
                        <td>
                            <a href="{{ route('maintenances.edit', [ $maintenance->id]) }}" class="btn btn-warning"> تعديل </a>
                            <form action="{{ route('maintenances.destroy', [ $maintenance->id]) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"> حذف </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
