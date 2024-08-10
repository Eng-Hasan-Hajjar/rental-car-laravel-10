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




            @if (Auth::user()->can('isEmployee') || Auth::user()->can('isAdmin'))

            <div class="container" style="margin-right: 10px;margin-left:100px">

                <h1 style="direction: rtl;text-align:center;padding-top:20px">السيارات</h1>
                <a href="{{ route('dashboard') }}" class="btn btn-primary"> لوحة التحكم  </a>

                <a href="{{ route('cars.create') }}" class="btn btn-primary">اضافة سيارة جديدة </a>
                 <table class="table mt-4"style="margin-left:300px">
                    <thead>
                        <tr>

                            <th>العلامة التجارية</th>
                            <th>الموديل</th>
                            <th>العام</th>

                            <th>عدد المقاعد</th>

                            <th>الحالة</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cars as $car)
                            <tr>

                                <td>{{ $car->brand }}</td>
                                <td>{{ $car->model }}</td>
                                <td>{{ $car->year }}</td>

                                <td>{{ $car->seats }}</td>
                                @if($car->status== "متوفرة")
                                     <td> متوفرة </td>
                                @elseif ($car->status== "غير متوفرة")
                                     <td>   غير متوفرة</td>

                                @else
                                 <td>   في الصيانة </td>
                                @endif

                                <td>

                                    <a href="{{ route('reservations.create', $car->id) }}" class="btn btn-primary">حجز الآن</a>

                                    <a href="{{ route('cars.show', $car->id) }}" class="btn btn-info">تفاصيل</a>
                                    <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-warning">تحرير</a>
                                    <form action="{{ route('cars.destroy', $car->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"onclick="return confirm('هل أنت متأكد من عملية الحذف؟');">حذف</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @else
            <div class="container" style="margin-right: 10px;margin-left:0px">
                <h1 style="direction: ltr;text-align:center;padding-top:20px">السيارات</h1>
                <a href="{{ route('dashboard') }}" class="btn btn-primary"> لوحة التحكم  </a>

                 <table class="table mt-4"style="margin-left:0px">
                    <thead>
                        <tr>

                            <th>العلامة التجارية</th>
                            <th>الموديل</th>
                            <th>العام</th>

                            <th>عدد المقاعد</th>

                            <th>الحالة</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cars as $car)
                            <tr>


                                <td>{{ $car->brand }}</td>
                                <td>{{ $car->model }}</td>
                                <td>{{ $car->year }}</td>

                                <td>{{ $car->seats }}</td>
                                        @if($car->status== "متوفرة")
                                            <td> متوفرة </td>
                                        @elseif ($car->status== "غير متوفرة")
                                                <td>   غير متوفرة</td>

                                        @else
                                            <td>   في الصيانة </td>
                                        @endif
                                <td>

                                    <a href="{{ route('reservations.create', $car->id) }}" class="btn btn-primary">حجز الآن</a>

                                    <a href="{{ route('cars.show', $car->id) }}" class="btn btn-info">تفاصيل</a>

                                </td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>



            @endcan




@endsection

@section('footer')
    <!-- DataTables -->
    {{ Html::script('admin/plugins/datatables/jquery.dataTables.min.js') }}
    {{ Html::script('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}
    {{ Html::script('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}
    {{ Html::script('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}
@endsection
