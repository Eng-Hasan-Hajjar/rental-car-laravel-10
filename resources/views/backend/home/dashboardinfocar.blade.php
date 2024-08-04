<head>
    <!-- إضافة Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="container mt-5">
    <div class="">
        @if(Auth::user()->can('isEmployee') || Auth::user()->can('isAdmin'))
            <div class="row mb-3">
                <div class="col-md-3">
                    <a href="{{ route('cars.create') }}" class="btn btn-success">إضافة سيارة جديدة</a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('reservations.create', ['car' => 1]) }}" class="btn btn-danger">إضافة حجز جديد</a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('cars.maintenances.create', ['car' => 1]) }}" class="btn btn-warning">إضافة صيانة جديدة</a> <!-- يجب تمرير معرف السيارة المناسب -->
                </div>
                <div class="col-md-3">
                    <a href="{{ route('garages.create') }}" class="btn btn-info">إضافة كراج جديد</a>
                </div>
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-car"></i> عدد السيارات</h5>
                    <p class="card-text display-4">{{ $carCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card text-white bg-secondary">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-user-tie"></i> عدد الزبائن</h5>
                    <p class="card-text display-4">{{ $customerCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-user-shield"></i> عدد المدراء</h5>
                    <p class="card-text display-4">{{ $adminCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-tools"></i> عدد الصيانات</h5>
                    <p class="card-text display-4">{{ $maintenanceCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-warehouse"></i> عدد الكراجات</h5>
                    <p class="card-text display-4">{{ $garageCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-calendar-alt"></i> عدد الحجوزات</h5>
                    <p class="card-text display-4">{{ $activeReservationsCount }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
