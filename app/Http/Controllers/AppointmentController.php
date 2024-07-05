<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::all();
        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        return view('appointments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_name' => 'required|string',
            'patient_email' => 'required|email',
            'patient_phone' => 'required|string',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|date_format:H:i', // Validate time format
            'referring_doctor' => 'required|string',
            'radiologist' => 'required|string',
            'appointment_type' => 'required|string',
        ]);

        // Check for double booking with the radiologist
        $existingRadiologistAppointment = Appointment::where('appointment_date', $request->appointment_date)
            ->where('appointment_time', $request->appointment_time)
            ->where('radiologist', $request->radiologist)
            ->exists();

        if ($existingRadiologistAppointment) {
            return back()->withInput()->withErrors(['error' => 'This appointment slot is already booked for the selected radiologist.']);
        }

        // Check for double booking with the patient
        $existingPatientAppointment = Appointment::where('appointment_date', $request->appointment_date)
            ->where('appointment_time', $request->appointment_time)
            ->where('patient_email', $request->patient_email)
            ->exists();

        if ($existingPatientAppointment) {
            return back()->withInput()->withErrors(['error' => 'This patient already has an appointment at the selected time.']);
        }

        // Create the appointment
        Appointment::create($request->all());

        return redirect()->route('appointments.index')->with('success', 'Appointment created successfully.');
    }

    public function show(Appointment $appointment)
    {
        return view('appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        return view('appointments.edit', compact('appointment'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'patient_name' => 'required|string',
            'patient_email' => 'required|email',
            'patient_phone' => 'required|string',
            'appointment_date' => 'required|date|after_or_equal:today', //Validate day
             'appointment_time' => 'required|date_format:H:i', // Validate time format
            'referring_doctor' => 'required|string',
            'radiologist' => 'required|string',
            'appointment_type' => 'required|string',
        ]);

        // Check for double booking with the radiologist, excluding the current appointment
        $existingRadiologistAppointment = Appointment::where('appointment_date', $request->appointment_date)
            ->where('appointment_time', $request->appointment_time)
            ->where('radiologist', $request->radiologist)
            ->where('id', '!=', $appointment->id)
            ->exists();

        if ($existingRadiologistAppointment) {
            return back()->withInput()->withErrors(['error' => 'This appointment slot is already booked for the selected radiologist.']);
        }

        // Check for double booking with the patient, excluding the current appointment
        $existingPatientAppointment = Appointment::where('appointment_date', $request->appointment_date)
            ->where('appointment_time', $request->appointment_time)
            ->where('patient_email', $request->patient_email)
            ->where('id', '!=', $appointment->id)
            ->exists();

        if ($existingPatientAppointment) {
            return back()->withInput()->withErrors(['error' => 'This patient already has an appointment at the selected time.']);
        }

        // Update the appointment
        $appointment->update($request->all());

        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully.');
    }
}
