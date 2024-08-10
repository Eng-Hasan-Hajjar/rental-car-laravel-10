<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarReservation;
use App\Models\Garage;
use App\Notifications\ReservationStatusNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarReservationController extends Controller
{
    public function index()
    {

        // تحقق مما إذا كان مديرًا وإذا لم يكن لديه معرف المستخدم (user_id)
        if (auth()->user()->role === 'admin' ) {
            $reservations = CarReservation::all();
            return view('backend.car_reservation.index', compact('reservations'));
        }

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

                // تحقق من أن السيارة غير محجوزة بالفعل في التواريخ المحددة
                $existingReservation = CarReservation::where('car_id', $request->car_id)
                    ->where(function ($query) use ($request) {
                        $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                            ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                            ->orWhere(function ($query) use ($request) {
                                $query->where('start_date', '<=', $request->start_date)
                                    ->where('end_date', '>=', $request->end_date);
                            });
                    })
                    ->exists();

                if ($existingReservation) {
                    return redirect()->back()->with('error', 'السيارة محجوزة بالفعل في هذه الفترة.');
                }


        $reservation = new CarReservation([
            'user_id' => Auth::id(),
            'car_id' => $car->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 'معلق',   // تعيين الحالة إلى معلق حتى يتم قبول الحجز
            'pickup_garage_id' => $request->pickup_garage_id,
            'dropoff_garage_id' => $request->dropoff_garage_id,
        ]);
      //  dd($reservation);
        $reservation->save();

        return redirect()->route('reservations.index')->with('success', 'تم تقديم طلب الحجز بنجاح. في انتظار موافقة المدير أو الموظف.');
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

    public function update(Request $request, CarReservation $reservation,Car $car)
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

                // تحقق من أن السيارة غير محجوزة بالفعل في التواريخ المحددة
                $existingReservation = CarReservation::where('car_id', $request->car_id)
                    ->where(function ($query) use ($request) {
                        $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                            ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                            ->orWhere(function ($query) use ($request) {
                                $query->where('start_date', '<=', $request->start_date)
                                    ->where('end_date', '>=', $request->end_date);
                            });
                    })
                    ->exists();

                if ($existingReservation) {
                    return redirect()->back()->with('error', 'السيارة محجوزة بالفعل في هذه الفترة.');
                }


       $request->validate([

            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
          'status' => 'required|in:pending,confirmed,cancelled',
            'pickup_garage_id' => 'required|exists:garages,id',
            'dropoff_garage_id' => 'required|exists:garages,id',
        ], $messages);


        $reservation = new CarReservation([

        ]);
      //  dd($reservation);
       // $reservation->save();
        $form_data = array(
            'user_id' => Auth::id(),
            'car_id' => $car->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status'=> $request->status,   // تعيين الحالة إلى معلق حتى يتم قبول الحجز
            'pickup_garage_id' => $request->pickup_garage_id,
            'dropoff_garage_id' => $request->dropoff_garage_id,

        );
        try {
            $reservation->update($form_data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'يوجد خطأ من أجل التحديث');
        }

           // $reservation->update($request->all());

        return redirect()->route('reservations.index')->with('success', 'تم التحديث.');
    }

    public function destroy(CarReservation $reservation)
    {
       $this->authorize('delete', $reservation);

        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Reservation deleted successfully.');
    }




    public function approveReservation(CarReservation $reservation)
    {
        $this->authorize('approve', $reservation); // تأكد من أن المستخدم لديه الصلاحية لقبول الحجز

      //  $reservation = CarReservation::findOrFail($id);
        // تغيير حالة الحجز إلى مثبت
        $reservation->update(['status' => 'مثبت']);

              // إرسال إشعار للمستخدم
    $status = $reservation->status;
    $car = $reservation->car;

    $reservation->user->notify(new ReservationStatusNotification($status, $car));

        return redirect()->back()->with('success', 'تم قبول الحجز بنجاح.');
    }

    public function rejectReservation(CarReservation $reservation)
    {
        $this->authorize('approve', $reservation); // تأكد من أن المستخدم لديه الصلاحية لرفض الحجز

        // تغيير حالة الحجز إلى إلغاء
        $reservation->update(['status' => 'إلغاء']);



               // إرسال إشعار للمستخدم
               $status = $reservation->status;
               $car = $reservation->car;

               $reservation->user->notify(new ReservationStatusNotification($status, $car));


        return redirect()->back()->with('success', 'تم رفض الحجز بنجاح.');
    }



}
