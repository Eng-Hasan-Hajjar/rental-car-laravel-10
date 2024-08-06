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
        <div class="card-header bg-primary text-white" style="">

            <h6 class=" "style=" text-align: center;">التفاصيل</h1>


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

            <div class="mb-3">
                <hr>
                <h4 class="text-center"> السيارات المتوفرة في الكراج </h6>
                    <p><strong>عدد السيارات:</strong> {{ $garage->cars->count() }}</p>
                <div class="row">
                    @foreach($garage->cars as $car)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                @if ($car->image)
                                    <img class="card-img-top img-thumbnail" src="{{ URL::to('/') }}/images/{{ $car->image }}"
                                     alt="{{ $car->model }}" style="width: 300px; height: 200px;">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $car->brand }} - {{ $car->model }}</h5>
                                    <p class="card-text"><strong>العام:</strong> {{ $car->year }}</p>
                                    <p class="card-text"><strong>اللون:</strong> {{ $car->color }}</p>
                                    <p class="card-text"><strong>عدد المقاعد:</strong> {{ $car->seats }}</p>
                                    <p class="card-text"><strong>الأجرة اليومية :</strong>  {{ $car->daily_rate }}   ل.س  </p>
                                    <p class="card-text"><strong>الحالة:</strong> {{ $car->status }}</p>
                                    <p class="card-text"><strong>الوصف:</strong> {{ $car->description }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <a href="{{ url('/adminpanel/garages') }}" class="btn btn-secondary" >  الكراجات  </a>
        </div>
    </div>
</div>
@endsection
