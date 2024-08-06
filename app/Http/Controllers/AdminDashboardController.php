<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarReservation;
use App\Models\Garage;
use App\Models\Maintenance;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {

        // جلب عدد الزبائن
        $customerCount = User::where('role', 'customer')->count();
        // جلب عدد المدراء
        $adminCount = User::where('role', 'admin')->count();
        $employeeCount = User::where('role', 'employee')->count();
         // جلب عدد السيارات
         $carCount = Car::count();
         $garageCount = Garage::count();
         $maintenanceCount=Maintenance::count();
         $activeReservationsCount = CarReservation::where('start_date', '<=', now())
         ->where('end_date', '>=', now())
         ->count();

        // تمرير البيانات إلى العرض
        return view('layouts.appcar', compact('maintenanceCount','customerCount', 'adminCount',  'carCount', 'activeReservationsCount', 'garageCount','employeeCount'));
    }
}
