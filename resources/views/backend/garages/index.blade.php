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
        <h1> الكراجات </h1>
        <a href="{{ route('dashboard') }}" class="btn btn-primary"> لوجة التحكم  </a>

        <a href="{{ route('garages.create') }}" class="btn btn-primary"> إنشاء جديد </a>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th> الرقم </th>
                    <th> الاسم </th>
                    <th> الموقع </th>
                    <th> رقم الهاتف </th>
                    <th> ساعات العمل </th>
                    <th> التحكم </th>
                </tr>
            </thead>
            <tbody>
                @foreach($garages as $garage)
                    <tr>
                        <td>{{ $garage->id }}</td>
                        <td>{{ $garage->name }}</td>
                        <td>{{ $garage->location }}</td>
                        <td>{{ $garage->phone_number }}</td>
                        <td>{{ $garage->working_hours }}</td>
                        <td>
                            <a href="{{ route('garages.show', $garage->id) }}" class="btn btn-info"> التفاصيل </a>
                            <a href="{{ route('garages.edit', $garage->id) }}" class="btn btn-warning">  التعديل </a>
                            <form action="{{ route('garages.destroy', $garage->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"onclick="return confirm('هل أنت متأكد من عملية الحذف؟');"> حذف </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
