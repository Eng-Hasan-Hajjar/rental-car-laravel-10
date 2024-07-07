<?php

namespace App\Http\Controllers;

use App\Models\Fleet;
use Illuminate\Http\Request;

class FleetController extends Controller
{
    public function index()
    {
        $fleets = Fleet::all();
        return view('fleets.index', compact('fleets'));
    }

    public function create()
    {
        return view('fleets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Fleet::create($request->all());

        return redirect()->route('fleets.index')->with('success', 'Fleet created successfully.');
    }

    public function show(Fleet $fleet)
    {
        return view('fleets.show', compact('fleet'));
    }

    public function edit(Fleet $fleet)
    {
        return view('fleets.edit', compact('fleet'));
    }

    public function update(Request $request, Fleet $fleet)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $fleet->update($request->all());

        return redirect()->route('fleets.index')->with('success', 'Fleet updated successfully.');
    }

    public function destroy(Fleet $fleet)
    {
        $fleet->delete();
        return redirect()->route('fleets.index')->with('success', 'Fleet deleted successfully.');
    }
}
