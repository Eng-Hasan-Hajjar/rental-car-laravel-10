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
                    @if($user->id == $visitor->user_id)  {{ $user->name }} @endif
                @endforeach</p>
                <p><strong> الهاتف:</strong> {{ $customer->phone}}</p>
                <p><strong> العمل:</strong> {{  $customer->work}}</p>
                <p><strong> الهواية:</strong> {{ $customer->hobby}}</p>
                <p><strong> الجنسية:</strong> {{ $customer->nationality}}</p>
                <p><strong> الموقع الحالي:</strong> {{ $customer->current_location}}</p>
                <p><strong> الجنس:</strong>   @if($customer->gender == 0) ذكر @else أنثى @endif</p>
                <p><strong> عدد المرافقين:</strong> {{ $customer->num_companion}}</p>
                <p><strong> فوبيا الظلام:</strong> @if($customer->is_phobia_dark == 0) لايوجد @else يوجد @endif</p>
                <p><strong> فوبيا الحيوانات:</strong>  @if($customer->is_phobia_animals == 0) لايوجد @else يوجد @endif</p>
                <p><strong> فوبيا الطيران:</strong>   @if($customer->is_phobia_fly == 0) لايوجد @else يوجد @endif</p>
                <p><strong> فوبيا البحر:</strong>  @if($customer->is_phobia_see == 0) لايوجد @else يوجد @endif</p>
                <p><strong> فوبيا الأماكن المفتوحة:</strong> @if($customer->is_phobia_open_space == 0) لايوجد @else يوجد @endif</p>
                <p><strong> فوبيا المرتفعات:</strong>  @if($customer->is_phobia_hights == 0) لايوجد @else يوجد @endif</p>
                <p><strong> تاريخ الميلاد:</strong> {{ $customer->birthday }}</p>

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























