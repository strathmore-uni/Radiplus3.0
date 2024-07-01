<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientDashboardController extends Controller
{
    public function index()
    {
        return view('patient.dashboard');
    }

    public function profile()
    {
        $user = auth()->user();
        return view('patient.profile', compact('user'));
    }

    public function appointments()
    {
        // Logic to fetch appointments for the authenticated patient
        $user = auth()->user();
        $appointments = $user->appointments()->orderBy('date', 'desc')->get();
        
        return view('patient.appointments', compact('appointments'));
    }

    // Add more methods for other features like viewing reports, managing settings, etc.
}
