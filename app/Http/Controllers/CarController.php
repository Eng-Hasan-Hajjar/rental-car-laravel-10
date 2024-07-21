<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('backend.cars.index', compact('cars'));
    }

    public function create()
    {
        return view('backend.cars.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|max:5000',
            'color' => 'required|string|max:50',
            'seats' => 'required|integer',
            'daily_rate' => 'required|numeric',
            'status' => 'required|string|max:50',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);




        $image = $request->file('image');

        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);

        $form_data = array(
            'brand' => $request->brand,
            'model' => $request->model,
            'year' => $request->year,
            'color' => $request->color,
            'seats' => $request->seats,
            'daily_rate' => $request->daily_rate,
            'status' => $request->status,
            'description'  => $request-> description,
            'image'  =>  $new_name,
        );


        Car::create($form_data);

        return redirect('/adminpanel/car')->with('success', 'Data Added successfully.');

        return redirect()->route('cars.index')->with('success', 'Car created successfully.');
    }

    public function show(Car $car)
    {
        return view('backend.cars.show', compact('car'));
    }

    public function edit(Car $car)
    {
        $id=$car->id;
        return view('backend.cars.edit', compact('car','id'));
    }

    public function update(Request $request, Car $car)
    { $request->validate([
        'brand' => 'required',

    ]);
    $image = $request->file('image');

    $new_name = rand() . '.' . $image->getClientOriginalExtension();
    $image->move(public_path('images'), $new_name);


    $form_data = array(
        'brand' => $request->brand,
        'model' => $request->model,
        'year' => $request->year,
        'color' => $request->color,
        'seats' => $request->seats,
        'daily_rate' => $request->daily_rate,
        'status' => $request->status,
        'description'  => $request-> description,
        'image'  =>  $new_name,

    );


    $car->update($form_data);

    return redirect()->route('cars.index')
        ->with('success', 'car updated successfully');

    }

    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.index')->with('success', 'Car deleted successfully.');
    }

    public function showCarDetails($id)
    {
        $car = Car::find($id);
        $user = Auth::user();

        // حساب السعر بناءً على مدة تسجيل المستخدم
        if ($user) {
            $discountedRate = $car->getDiscountedRate($user);
        } else {
            $discountedRate = $car->daily_rate;
        }

        return view('car.details', compact('car', 'discountedRate'));
    }



}
