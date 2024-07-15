<?php

// app/Http/Controllers/RadiologistController.php

namespace App\Http\Controllers;

use App\Models\Radiologist;
use Illuminate\Http\Request;

class RadiologistController extends Controller
{
    public function index()
    {
        // Display a listing of radiologists
        $radiologists = Radiologist::all();
        return view('admin.radiologist.manage', compact('radiologists'));
    }

    public function create()
    {
        // Show the form for creating a new radiologist
        return view('admin.radiologist.create');
    }

    public function store(Request $request)
    {
        // Store a new radiologist
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:radiologists',
            'password' => 'required|confirmed',
            'phone' => 'required',
            'address' => 'required',
        ]);

        Radiologist::create($request->all());
        return redirect()->route('radiologist.index');
    }

    public function edit(Radiologist $radiologist)
    {
        // Show the form for editing a radiologist
        return view('admin.radiologist.edit', compact('radiologist'));
    }

    public function update(Request $request, Radiologist $radiologist)
    {
        // Update a radiologist
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:radiologists,email,' . $radiologist->id,
            'phone' => 'required',
            'address' => 'required',
        ]);

        $radiologist->update($request->all());
        return redirect()->route('radiologist.index');
    }

    public function destroy(Radiologist $radiologist)
    {
        // Delete a radiologist
        $radiologist->delete();
        return redirect()->route('radiologist.index');
    }
}