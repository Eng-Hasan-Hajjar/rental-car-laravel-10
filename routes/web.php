<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampGroundController;
use App\Http\Controllers\ReservationController;

use App\Http\Controllers\ArmanController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\CampDoctorGuidController;
use App\Http\Controllers\RatingController;

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\GarageController;
use Symfony\Component\Console\Input\Input;




##CAR RENTAL

Route::middleware(['auth'])->group(function () {

    Route::resource('/adminpanel/car', CarController::class);
    Route::resource('/adminpanel/garages', GarageController::class);
});


























Route::get('locale/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'ar'])) {
        abort(400);
    }
    session(['locale' => $locale]);
    App::setLocale($locale);
    return redirect()->back();
})->name('locale.change');

Route::get('showallcamp', [CampGroundController::class, 'showAllCamp'])->name('showallcamp.showAllCamp');
Route::get('singelcamp/{id}',[CampGroundController::class, 'showSingle'])->name('singelcamp.showSingle');
Route::get('forest',[CampGroundController::class, 'forest'])->name('camp.forest');
Route::get('desert',[CampGroundController::class, 'desert'])->name('camp.desert');
Route::get('mountain',[CampGroundController::class, 'mountain'])->name('camp.mountain');
Route::get('ratings', [RatingController::class, 'index'])->name('ratings.index');

Route::get('/', function () {
    return view('frontend.index');
});



// روابط CRUD الخاصة بـ CampDoctorGuid
Route::resource('adminpanel/camp_doctor_guid', CampDoctorGuidController::class);



Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');
Route::get('/camp-grounds/{camp_ground_id}/ratings', [RatingController::class, 'show'])->name('ratings.show');
Route::get('/campgrounds/{id}/ratings', [CampgroundController::class, 'showRatings'])->name('campground.ratings');

// routes/web.php


Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');


Route::get('/n', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

});

/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

*/





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


/////////////////////////////////////---CampGround

/*
Route::get('/campground', function () {
    return view('backend.campGround');
})->middleware(['auth', 'verified'])->name('campground');

Route::middleware(['auth'])->group(function () {

    Route::get('/campground', [CampgroundController::class, 'index'])->name('campground');

});

*/
#-------------camping grounds

Route::middleware(['auth'])->group(function () {

    //Route::get('/campground1', [CampgroundController::class, 'index'])->name('campground1');

    Route::resource('/adminpanel/campground', CampGroundController::class);

   // Route::resource('/campground', CampGroundController::class);

});






#-------------Armenia module

Route::middleware(['auth'])->group(function () {



  //  Route::resource('/adminpanel/arman', ArmanController::class);



});



#-------------reservation routes

Route::middleware(['auth'])->group(function () {

    Route::resource('/adminpanel/reservations', ReservationController::class);



/*
// عرض النموذج لإنشاء حجز جديد
Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');

// حفظ الحجز الجديد في قاعدة البيانات
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('/getreservations', [ReservationController::class, 'showAll'])->name('reservations.showAll');

// عرض التفاصيل لحجز معين
Route::get('/reservations/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');

// عرض جميع الحجوزات
Route::get('/reservations/all', [ReservationController::class, 'showAll'])->name('reservations.all');

// عرض النموذج لتعديل حجز معين
Route::get('/reservations/{reservation}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');

// تحديث بيانات الحجز في قاعدة البيانات
Route::put('/reservations/{reservation}', [ReservationController::class, 'update'])->name('reservations.update');

// حذف حجز معين من قاعدة البيانات
Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
*/
});




Route::middleware('auth')->group(function () {

    Route::resource('/adminpanel/doctors', DoctorController::class);

    Route::resource('/adminpanel/guides', GuideController::class);

    Route::resource('/adminpanel/visitors', VisitorController::class);

    Route::post('/adminpanel/visitor', [VisitorController::class, 'input'])->name('visitors.input');

    Route::get('/adminpanel/visitor', [VisitorController::class, 'input'])->name('visitors.input');


    Route::get('/visitors/user/{userId}', [VisitorController::class, 'showVisitorByUserId'])->name('visitors.showByUserId');
});

