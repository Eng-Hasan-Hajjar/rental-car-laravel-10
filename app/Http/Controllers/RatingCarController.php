<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingCarController extends Controller
{
    public function index(Car $car)
    {
        $ratings = $car->ratings()->with('user')->get();
        return view('ratings.index', compact('car', 'ratings'));
    }

    public function create(Car $car)
    {
        return view('ratings.create', compact('car'));
    }

    public function store(Request $request, Car $car)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $rating = new Rating([
            'user_id' => Auth::id(),
            'car_id' => $car->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        $rating->save();

        return redirect()->route('cars.show', $car->id)->with('success', 'Rating added successfully.');
    }
}
