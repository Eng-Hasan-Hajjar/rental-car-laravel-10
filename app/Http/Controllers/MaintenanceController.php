<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Maintenance;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index(Car $car)
    {
        $maintenances = $car->maintenances()->get();
        return view('maintenances.index', compact('car', 'maintenances'));
    }

    public function create(Car $car)
    {
        return view('maintenances.create', compact('car'));
    }

    public function store(Request $request, Car $car)
    {
        $request->validate([
            'date' => 'required|date',
            'details' => 'required|string',
        ]);

        $maintenance = new Maintenance([
            'car_id' => $car->id,
            'date' => $request->date,
            'details' => $request->details,
        ]);

        $maintenance->save();

        return redirect()->route('maintenances.index', $car->id)->with('success', 'Maintenance record added successfully.');
    }

    public function edit(Car $car, Maintenance $maintenance)
    {
        return view('maintenances.edit', compact('car', 'maintenance'));
    }

    public function update(Request $request, Car $car, Maintenance $maintenance)
    {
        $request->validate([
            'date' => 'required|date',
            'details' => 'required|string',
        ]);

        $maintenance->update($request->all());

        return redirect()->route('maintenances.index', $car->id)->with('success', 'Maintenance record updated successfully.');
    }

    public function destroy(Car $car, Maintenance $maintenance)
    {
        $maintenance->delete();
        return redirect()->route('maintenances.index', $car->id)->with('success', 'Maintenance record deleted successfully.');
    }
}
