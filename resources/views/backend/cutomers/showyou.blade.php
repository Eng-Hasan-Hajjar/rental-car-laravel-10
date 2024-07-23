<!-- resources/views/reservations/show.blade.php -->

@extends('admin.layouts.layoutvisitor')

@section('title')
    تفاصيل
@endsection

@section('header')
    {{ Html::style('hdesign/hstyle.css') }}
    <!-- DataTables -->
    {{ Html::style('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}
    {{ Html::style('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}
@endsection

@section('content')
    <div class="container hcontainer">
        <div class="card hcard">
            <div class="card-header">التفاصيل </div>

            <div class="card-body hcard-body">
                <table>
                    <tr>
                        <td>
                            <p><strong> الاسم:</strong>
                                {{ Auth::user()->name }}
                           </p>
                    </td>
                        <td>
                            <p><strong> الهاتف:</strong> {{ $customer->phone}}</p>
                    </td>

                    </tr>
                    <tr>
                        <td>

                             <p><strong> العمل:</strong> {{  $customer->work}}</p>
                    </td>
                        <td>

                <p><strong> الهواية:</strong> {{ $customer->hobby}}</p>
                    </td>

                    </tr>
                    <tr>
                        <td>
                            <p><strong> الجنسية:</strong> {{ $customer->nationality}}</p>
                    </td>
                        <td>

                <p><strong> الموقع الحالي:</strong> {{ $customer->current_location}}</p>
                    </td>

                    </tr>
                    <tr>
                        <td>
                            <p><strong> الجنس:</strong>   @if($customer->gender == 0) ذكر @else أنثى @endif</p>
                    </td>
                        <td>
                            <p><strong> عدد المرافقين:</strong> {{ $customer->num_companion}}</p>
                    </td>

                    </tr>
                    <tr>
                        <td>
                            <p><strong> فوبيا الظلام:</strong> @if($customer->is_phobia_dark == 0) لايوجد @else يوجد @endif</p>

                    </td>
                        <td>
                            <p><strong> فوبيا الحيوانات:</strong>  @if($customer->is_phobia_animals == 0) لايوجد @else يوجد @endif</p>

                    </td>

                    </tr>

                    <tr>
                        <td>
                            <p><strong> فوبيا الطيران:</strong>   @if($customer->is_phobia_fly == 0) لايوجد @else يوجد @endif</p>

                    </td>
                        <td>
                            <p><strong> فوبيا البحر:</strong>  @if($customer->is_phobia_see == 0) لايوجد @else يوجد @endif</p>

                    </td>
                    </tr>
                    <tr>
                        <td>
                            <p><strong> فوبيا الأماكن المفتوحة:</strong> @if($customer->is_phobia_open_space == 0) لايوجد @else يوجد @endif</p>

                    </td>
                        <td>
                            <p><strong> فوبيا المرتفعات:</strong>  @if($customer->is_phobia_hights == 0) لايوجد @else يوجد @endif</p>

                        </td>

                    </tr>

                    <tr>

                        <td>

                        </td>
                        <td>
                            <p><strong> تاريخ الميلاد:</strong> {{ $customer->birthday }}</p>

                        </td>

                    </tr>

                  </table>

                <!-- تفاصيل  -->






                <div class="btn-group">
                    <a href="{{ route('customers.edit', $customer) }}" class="btn btn-primary">تعديل</a>

                    <a href="{{ url('dashboard') }}" class="btn btn-secondary">رجوع</a>

                </div>






            </div>
        </div>
    </div>
@endsection























