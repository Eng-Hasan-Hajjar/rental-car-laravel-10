<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\CarReservation;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function index()
    {
        $ratings = Rating::with(['user', 'car'])->get();
        return view('backend.ratings.index', compact('ratings'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);
        $user = Auth::user();
           // تحقق من وجود تقييم سابق
        $existingRating = Rating::where('user_id', auth()->id())
        ->where('car_id', $request->car_id)
        ->first();

        if ($existingRating) {

            return redirect()->back()
                ->with('error', 'لا يمكنك تقديم تقييم أكثر من مرة لنفس السيارة.');
        }


        // تحقق من وجود حجز سابق
        $hasReservation = CarReservation::where('user_id', $user->id)
        ->where('car_id', $request->car_id)
        ->exists();

        if (!$hasReservation) {
        return redirect()->back()
            ->with('error', 'لا يمكنك تقييم هذه السيارة لأنك لم تحجزها.');
        }


        Rating::create([
            'user_id' => Auth::id(),
            'car_id' => $request->car_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'تم إضافة تقييمك بنجاح.');
    }

    public function show($car_id)
    {
        $ratings = Rating::where('car_id', $car_id)->get();
        return view('backend.cars.ratings', compact('ratings'));
    }
    public function showallratings($id)

    {
       // $ratings = Rating::where('camp_ground_id', $id)->get();
        $car = Car::with('ratings.user')->findOrFail($id);
        return view('backend.cars.show', compact('car','ratings'));
    }


}
