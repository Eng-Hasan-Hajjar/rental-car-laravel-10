<?php
use App\Http\Controllers\AdminDashboardCarController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarReservationController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FleetController;
use App\Http\Controllers\GarageController;
use App\Http\Controllers\MaintenanceController;
Route::get('/', function () {
    return view('frontend.index');
});



Route::get('ratings', [RatingController::class, 'index'])->name('ratings.index');
Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');
Route::get('/cars/{camp_ground_id}/ratings', [RatingController::class, 'show'])->name('ratings.show');
Route::get('/cars/{id}/ratings', [CarController::class, 'showRatings'])->name('car.ratings');




Route::middleware(['auth'])->group(function () {
    Route::resource('/adminpanel/car', CarController::class);
    Route::resource('/adminpanel/garages', GarageController::class);
    Route::resource('/adminpanel/maintenances', MaintenanceController::class);
});
Route::middleware(['auth'])->group(function () {
    Route::resource('cars', CarController::class);

    Route::prefix('cars/{car}')->group(function () {
        Route::get('maintenances', [MaintenanceController::class, 'index'])->name('cars.maintenances.index');
        Route::get('maintenances/create', [MaintenanceController::class, 'create'])->name('cars.maintenances.create');
        Route::post('maintenances', [MaintenanceController::class, 'store'])->name('cars.maintenances.store');
        Route::get('maintenances/{maintenance}', [MaintenanceController::class, 'show'])->name('cars.maintenances.show');
        Route::get('maintenances/{maintenance}/edit', [MaintenanceController::class, 'edit'])->name('cars.maintenances.edit');
        Route::put('maintenances/{maintenance}', [MaintenanceController::class, 'update'])->name('cars.maintenances.update');
        Route::delete('maintenances/{maintenance}', [MaintenanceController::class, 'destroy'])->name('cars.maintenances.destroy');
    });
});
Route::middleware(['auth'])->group(function () {
    Route::get('reservations', [CarReservationController::class, 'index'])->name('reservations.index');
    Route::get('cars/{car}/reservations/create', [CarReservationController::class, 'create'])->name('reservations.create');
    Route::post('cars/{car}/reservations', [CarReservationController::class, 'store'])->name('reservations.store');
    Route::get('reservations/{reservation}', [CarReservationController::class, 'show'])->name('reservations.show');
    Route::get('reservations/{reservation}/edit', [CarReservationController::class, 'edit'])->name('reservations.edit');
    Route::put('reservations/{reservation}', [CarReservationController::class, 'update'])->name('reservations.update');
    Route::delete('reservations/{reservation}', [CarReservationController::class, 'destroy'])->name('reservations.destroy');
});
Route::middleware(['auth'])->group(function () {
    Route::resource('fleets', FleetController::class);
});
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
});
Route::middleware('auth')->group(function () {
    Route::get('/dashboardcar', [AdminDashboardController::class, 'index'])->name('dashboardcar');
});
Route::middleware('auth')->group(function () {
    Route::resource('/adminpanel/customers', CustomerController::class);
    Route::post('/adminpanel/customers2', [CustomerController::class, 'input'])->name('customers2.input');
    Route::get('/adminpanel/customers2', [CustomerController::class, 'input'])->name('customers2.input');
    Route::post('/adminpanel/customers2', [CustomerController::class, 'input2'])->name('customers2.input2');
    Route::get('/customers/user/{userId}', [CustomerController::class, 'showCustomerByUserId'])->name('customers.showByUserId');

});
Route::get('/n', function () {
    return view('welcome');
});

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';





Route::patch('/reservations/{reservation}/approve', [CarReservationController::class, 'approveReservation'])
    ->name('reservations.approve');

Route::patch('/reservations/{reservation}/reject', [CarReservationController::class, 'rejectReservation'])
    ->name('reservations.reject');


Route::get('ratings2', [RatingController::class, 'index'])->name('ratings2.index');
