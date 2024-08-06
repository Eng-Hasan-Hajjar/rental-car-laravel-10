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

<div class="container mt-5" style="text-align: center">


    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-car"></i> عدد السيارات</h5>
                    <p class="card-text display-6">{{ $carCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-user-tie"></i> عدد الزبائن</h5>
                    <p class="card-text display-6">{{ $customerCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-1">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-user-shield"></i> عدد الموظفين</h5>
                    <p class="card-text display-6">{{ $employeeCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-tools"></i> عدد الصيانات</h5>
                    <p class="card-text display-12">{{ $maintenanceCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-6">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-warehouse"></i> عدد الكراجات</h5>
                    <p class="card-text display-12">{{ $garageCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-calendar-alt"></i> عدد الحجوزات</h5>
                    <p class="card-text display-6">{{ $activeReservationsCount }}</p>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="container mt-10" style="float:center;position:center; ">
    @if(Auth::user()->can('isEmployee') || Auth::user()->can('isAdmin'))
        <div class="row mb-6"style="float:center;position:center; ">
            <div class="col-md-1">
                <a href="{{ route('cars.create') }}" class="btn btn-success">إضافة سيارة </a>
            </div>
            <div class="col-md-1">
                <a href="{{ route('reservations.create', ['car' => 1]) }}" class="btn btn-danger">إضافة حجز </a>
            </div>
            <div class="col-md-1">
                <a href="{{ route('cars.maintenances.create', ['car' => 1]) }}" class="btn btn-warning">إضافة صيانة </a> <!-- يجب تمرير معرف السيارة المناسب -->
            </div>
            <div class="col-md-1">
                <a href="{{ route('garages.create') }}" class="btn btn-info">إضافة كراج </a>
            </div>
        </div>
    @endif
</div>
