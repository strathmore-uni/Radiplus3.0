<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Record; // Assuming you have a Record model
use Illuminate\Support\Facades\Auth;

class RecordController extends Controller
{
    // Constructor to apply middleware for access control
    public function __construct()
    {
        $this->middleware(['role:radiologist,referring_doctor']);
    }

    // Display a list of records
    public function index()
    {
        $records = Record::paginate(10); // Or use custom query based on user roles
        return view('records.index', compact('records'));
    }

    // Show the details of a specific record
    public function show(Record $record)
    {
        return view('records.show', compact('record'));
    }

    // Show form to create a new record
    public function create()
    {
        return view('records.create');
    }

    // Store a new record
    public function store(Request $request)
    {
        $request->validate([
            'patient_name' => 'required',
            'diagnosis' => 'required',
            'treatment' => 'required',
            'notes' => 'nullable',
        ]);

        $record = new Record();
        $record->patient_name = $request->patient_name;
        $record->diagnosis = $request->diagnosis;
        $record->treatment = $request->treatment;
        $record->notes = $request->notes;
        $record->created_by = Auth::id(); // Store the ID of the user who created the record
        $record->save();

        return redirect()->route('records.index')->with('success', 'Record created successfully');
    }

    // Delete a specific record
    public function destroy(Record $record)
    {
        $record->delete();
        return redirect()->route('records.index')->with('success', 'Record deleted successfully');
    }
}
