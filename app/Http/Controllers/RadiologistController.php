<?php

namespace App\Http\Controllers;

use App\Models\Radiologist;
use Illuminate\Http\Request;

class RadiologistController extends Controller
{
    public function index()
    {
        $radiologists = Radiologist::all();
        return view('radiologists.index', compact('radiologists'));
    }

    public function create()
    {
        return view('radiologists.create');
    }

    public function store(Request $request)
    {
        $radiologist = Radiologist::create($request->all());
        return redirect()->route('radiologists.index');
    }

    public function show(Radiologist $radiologist)
    {
        return view('radiologists.show', compact('radiologist'));
    }

    public function edit(Radiologist $radiologist)
    {
        return view('radiologists.edit', compact('radiologist'));
    }

    public function update(Request $request, Radiologist $radiologist)
    {
        $radiologist->update($request->all());
        return redirect()->route('radiologists.index');
    }

    public function destroy(Radiologist $radiologist)
    {
        $radiologist->delete();
        return redirect()->route('radiologists.index');
    }
}
