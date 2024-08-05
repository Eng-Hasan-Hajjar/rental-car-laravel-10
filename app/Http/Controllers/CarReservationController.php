<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarReservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarReservationController extends Controller
{
    public function index()
    {
        $reservations = CarReservation::with('car')->where('user_id', Auth::id())->get();
        return view('backend.car_reservation.index', compact('reservations'));
    }

    public function create(Car $car)
    {
        return view('backend.car_reservation.create', compact('car'));
    }

    public function store(Request $request, Car $car)
    {
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        $reservation = new CarReservation([
            'user_id' => Auth::id(),
            'car_id' => $car->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 'pending',
        ]);

        $reservation->save();

        return redirect()->route('reservations.index')->with('success', 'Reservation created successfully.');
    }

    public function show(CarReservation $reservation)
    {
        // التحقق من صلاحيات المستخدم لعرض الحجز
        $this->authorize('view', $reservation);
        // إيجاد السيارة المرتبطة بالحجز
        $car = $reservation->car;
        $user = Auth::user();
        // حساب السعر النهائي وتفاصيل الخصم
        $discountDetails = [];

        // حساب السعر النهائي بناءً على مدة تسجيل المستخدم والخصومات الموسمية
        if ($user) {
            $discountDetails = $car->getDiscountDetails($user);
            $finalRate = $car->getFinalRate($user);
        } else {
            $finalRate = $car->daily_rate;
        }
        // عرض النتائج في العرض المحدد
        return view('backend.car_reservation.show', compact('reservation', 'car', 'finalRate', 'discountDetails'));
    }

    public function edit(CarReservation $reservation)
    {
        $this->authorize('update', $reservation);

        return view('backend.car_reservation.edit', compact('reservation'));
    }

    public function update(Request $request, CarReservation $reservation)
    {
        $this->authorize('update', $reservation);

        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $reservation->update($request->all());

        return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully.');
    }

    public function destroy(CarReservation $reservation)
    {
       $this->authorize('delete', $reservation);

        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Reservation deleted successfully.');
    }
}
