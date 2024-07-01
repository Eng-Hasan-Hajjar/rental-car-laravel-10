<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Garage;

class GarageController extends Controller
{
    public function index()
    {
        $garages = Garage::all();
        return view('garages.index', compact('garages'));
    }

    public function create()
    {
        return view('garages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'working_hours' => 'required|string|max:255',
        ]);

        Garage::create($request->all());

        return redirect()->route('garages.index')->with('success', 'Garage created successfully.');
    }

    public function show(Garage $garage)
    {
        return view('garages.show', compact('garage'));
    }

    public function edit(Garage $garage)
    {
        return view('garages.edit', compact('garage'));
    }

    public function update(Request $request, Garage $garage)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'working_hours' => 'required|string|max:255',
        ]);

        $garage->update($request->all());

        return redirect()->route('garages.index')->with('success', 'Garage updated successfully.');
    }

    public function destroy(Garage $garage)
    {
        $garage->delete();
        return redirect()->route('garages.index')->with('success', 'Garage deleted successfully.');
    }
}
