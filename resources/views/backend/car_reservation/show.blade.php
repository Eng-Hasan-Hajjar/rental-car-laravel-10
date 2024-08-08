@extends(Auth::user()->can('isEmployee') || Auth::user()->can('isAdmin') ? 'admin.layouts.layout' : 'admin.layouts.layoutvisitor')

@section('title', 'التحكم')

@section('header')
    <!-- DataTables -->
    {{ Html::style('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}
    {{ Html::style('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}
@endsection

@section('content')
    <div class="container mt-5 d-flex justify-content-center">
        <div class="card w-75">
            <div class="card-header bg-primary text-white text-center">
                <h1>تفاصيل الحجز</h1>
            </div>
            <div class="card-body text-center">
                <div class="mb-3">
                    <strong>السيارة:</strong> {{ $reservation->car->brand }} {{ $reservation->car->model }}
                </div>
                <div class="mb-3">
                    <strong>تاريخ البداية:</strong> {{ $reservation->start_date }}
                </div>
                <div class="mb-3">
                    <strong>تاريخ النهاية:</strong> {{ $reservation->end_date }}
                </div>
                <div class="mb-3">
                    <strong>الحالة:</strong> {{ ucfirst($reservation->status) }}
                </div>

                <div class="mb-3">
                    <strong>كراج الاستلام:</strong> {{ $reservation->pickupGarage->name }}
                </div>
                <div class="mb-3">
                    <strong>كراج التسليم:</strong> {{ $reservation->dropoffGarage->name }}
                </div>

                <div class="mb-3">
                    <strong>السعر اليومي الأساسي:</strong> {{ $car->daily_rate }} ليرة
                </div>
                @if($discountDetails['user_discount'] > 0)
                    <div class="mb-3">
                        <strong>خصم بسبب مدة التسجيل:</strong> {{ $discountDetails['user_discount'] }}%
                    </div>
                @endif
                @if($discountDetails['seasonal_discount'] > 0)
                    <div class="mb-3">
                        <strong>خصم موسمي:</strong> {{ $discountDetails['seasonal_discount'] }}%
                    </div>
                @endif
                <div class="mb-3">
                    <strong>السعر اليومي بعد الخصم:</strong> {{ $finalRate }} ليرة
                </div>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-warning mx-2">تعديل</a>
                    <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger mx-2">حذف</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
