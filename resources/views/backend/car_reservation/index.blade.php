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
    <div class="container" style="margin-right: 10px;margin-left:100px">
        <h1>حجوزاتك </h1>
        <a href="{{ route('dashboard') }}" class="btn btn-primary"> لوحة التحكم  </a>

        <table class="table mt-4">
            <thead>
                <tr>
                    <th>رقم الحجز </th>
                    <th> السيارة </th>
                    <th> تاريخ البداية </th>
                    <th> تاريخ النهاية </th>
                    <th> الحالة </th>
                    <th> التحكم </th>
                    <th>   </th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->id }}</td>
                        <td>{{ $reservation->car->brand }} {{ $reservation->car->model }}</td>
                        <td>{{ $reservation->start_date }}</td>
                        <td>{{ $reservation->end_date }}</td>
                        <td>{{ ucfirst($reservation->status) }}</td>
                        <td>
                            <a href="{{ route('reservations.show', $reservation->id) }}" class="btn btn-info">التفاصيل </a>
                            <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-warning"> تعديل </a>
                            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من عملية الحذف؟');"> حذف </button>
                            </form>
                        </td>
                        <td>
                            @if(Auth::user()->can('isEmployee') || Auth::user()->can('isAdmin'))
                                @if(Auth::user()->can('approve', $reservation))
                                    <form action="{{ route('reservations.approve', $reservation->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success">قبول</button>
                                    </form>

                                    <form action="{{ route('reservations.reject', $reservation->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-danger">رفض</button>
                                    </form>
                                @endif
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
