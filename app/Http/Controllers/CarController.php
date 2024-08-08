<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Garage;
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
        $garages=Garage::all();
        return view('backend.cars.create',compact('garages'));
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
            'garage_id' => $request-> garage_id,
            'image'  =>  $new_name,
        );
       // dd($form_data);

        Car::create($form_data);

        return redirect('/adminpanel/car')->with('success', 'تمت الإضافة بنجاح ');

        return redirect()->route('cars.index')->with('success', 'Car created successfully.');
    }

    public function show(Car $car)
    {
        //$car = Car::find($id);
        $user = Auth::user();

        /* حساب السعر بناءً على مدة تسجيل المستخدم
        if ($user) {
            $discountedRate = $car->daily_rate - $car->getDiscountedRate($user);
        } else {

        }
        */
        $discountedRate = $car->daily_rate;
        $garages=Garage::all();
        return view('backend.cars.show', compact('car', 'discountedRate','garages'));
    }

    public function edit(Car $car)
    {
        $id=$car->id;
        $garages=Garage::all();
        return view('backend.cars.edit', compact('car','id','garages'));
    }

    public function update(Request $request, Car $car)
    {

        $request->validate([
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
        'garage_id' => $request-> garage_id,
        'image'  =>  $new_name,

    );


    $car->update($form_data);

    return redirect()->route('cars.index')
        ->with('success', 'تم تحديث السيارة بنجاح');

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
