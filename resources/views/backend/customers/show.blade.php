<!-- resources/views/reservations/show.blade.php -->

@extends('admin.layouts.layout')

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
                <!-- تفاصيل  -->
                <p><strong> الاسم:</strong>  @foreach ($users as $user)
                    @if($user->id == $customer->user_id)  {{ $user->name }} @endif
                @endforeach</p>
                <p><strong> الهاتف:</strong> {{ $customer->phone}}</p>
                <p><strong> العمل:</strong> {{  $customer->work}}</p>
                <p><strong> الجنسية:</strong> {{ $customer->nationality}}</p>
                <p><strong> الموقع الحالي:</strong> {{ $customer->current_location}}</p>
                <p><strong> الجنس:</strong>   @if($customer->gender == 0) ذكر @else أنثى @endif</p>
                <p><strong> تاريخ الميلاد:</strong> {{ $customer->birthday }}</p>
                <p><strong> رقم الشهادة:</strong> {{ $customer->driving_license_number}}</p>
                <div class="btn-group">
                    <a href="{{ route('customers.edit', $customer) }}" class="btn btn-primary">تعديل</a>
                    <form action="{{ route('customers.destroy', $customer) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"onclick="return confirm('هل أنت متأكد من رغبتك في حذف هذا الزائر؟ ')">حذف</button>
                    </form>
                    <a href="{{ url('/adminpanel/customers') }}" class="btn btn-secondary">رجوع</a>

                </div>






            </div>
        </div>
    </div>
@endsection























