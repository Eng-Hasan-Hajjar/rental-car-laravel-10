<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarReservation;
use App\Models\Garage;
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
        $garages=Garage::all();
        return view('backend.car_reservation.create', compact('car','garages'));
    }

    public function store(Request $request, Car $car)
    {
        $messages = [
            'start_date.required' => 'حقل  التاريخ مطلوب',
            'start_date.after_or_equal' => 'حقل  التاريخ يجب أن يكون من اليوم فما بعد ',
            'end_date.after' => 'حقل  التاريخ يجب أن يكون من يوم البداية  فما بعد ',
            'start_date.required' => 'تاريخ البدء مطلوب.',
            'start_date.date' => 'تاريخ البدء يجب أن يكون تاريخاً صالحاً.',
            'start_date.after_or_equal' => 'تاريخ البدء يجب أن يكون اليوم أو تاريخاً مستقبلياً.',
            'end_date.required' => 'تاريخ الانتهاء مطلوب.',
            'end_date.date' => 'تاريخ الانتهاء يجب أن يكون تاريخاً صالحاً.',
            'end_date.after' => 'تاريخ الانتهاء يجب أن يكون بعد تاريخ البدء.',
            'status.required' => 'الحالة مطلوبة.',
            'status.in' => 'الحالة يجب أن تكون واحدة من التالي: معلق، مؤكد، ملغى.',

        ];

        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'pickup_garage_id' => 'required|exists:garages,id',
            'dropoff_garage_id' => 'required|exists:garages,id',

        ], $messages);
      //  dd($request);

        $reservation = new CarReservation([
            'user_id' => Auth::id(),
            'car_id' => $car->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 'معلق',
            'pickup_garage_id' => $request->pickup_garage_id,
            'dropoff_garage_id' => $request->dropoff_garage_id,
        ]);
      //  dd($reservation);
        $reservation->save();

        return redirect()->route('reservations.index')->with('success', 'تم انشاء الحجز بنجاح');
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
        $garages=Garage::all();

        return view('backend.car_reservation.edit', compact('reservation','garages'));
    }

    public function update(Request $request, CarReservation $reservation)
    {
        $this->authorize('update', $reservation);
        $messages = [
            'start_date.required' => 'حقل  التاريخ مطلوب',
            'start_date.after_or_equal' => 'حقل  التاريخ يجب أن يكون من اليوم فما بعد ',
            'end_date.after' => 'حقل  التاريخ يجب أن يكون من يوم البداية  فما بعد ',

            'start_date.required' => 'تاريخ البدء مطلوب.',
            'start_date.date' => 'تاريخ البدء يجب أن يكون تاريخاً صالحاً.',
            'start_date.after_or_equal' => 'تاريخ البدء يجب أن يكون اليوم أو تاريخاً مستقبلياً.',
            'end_date.required' => 'تاريخ الانتهاء مطلوب.',
            'end_date.date' => 'تاريخ الانتهاء يجب أن يكون تاريخاً صالحاً.',
            'end_date.after' => 'تاريخ الانتهاء يجب أن يكون بعد تاريخ البدء.',
            'status.required' => 'الحالة مطلوبة.',
            'status.in' => 'الحالة يجب أن تكون واحدة من التالي: معلق، مؤكد، ملغى.',


        ];

       $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:pending,confirmed,cancelled',
        ], $messages);

        try {
            $reservation->update($request->all());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the reservation. Please try again.');
        }

           // $reservation->update($request->all());

        return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully.');
    }

    public function destroy(CarReservation $reservation)
    {
       $this->authorize('delete', $reservation);

        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Reservation deleted successfully.');
    }
}
