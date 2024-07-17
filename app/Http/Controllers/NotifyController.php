<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;
use App\Notifications\PatientAppointmentNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\LabOrder;

class NotifyController extends Controller
{
    public static function sendNotification(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        $details = [
            'greeting' => 'Hello, ' . $user->name,
            'body' => 'You have a new notification.',
            'actiontext' => 'View Details',
            'actionurl' => url('/'),
            'endpart' => 'Thank you for using our application!'
        ];

        Notification::send($user, new PatientAppointmentNotification($details));

        return back()->with('message', 'Notification sent successfully!');
    }

    public static function approveAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'approved';
        $appointment->save();

        // Get all users with usertype 0 (patients)
        $patients = User::where('usertype', 0)->get();

        foreach ($patients as $patient) {
            $details = [
                'greeting' => 'Hello, ' . $patient->name,
                'body' => 'Your appointment has been approved. I am Available at 10:00am-12:00pm only.Check the system for more details.',
                'actiontext' => 'View Appointment',
                'actionurl' => url('/'),
                'endpart' => 'Thank you for using Radiplus!'
            ];

            Notification::send($patient, new PatientAppointmentNotification($details));
        }

        return back()->with('message', 'Appointment approved and notifications sent.Available at 10:00-12:00pm only');
    }

    public static function cancelAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'cancelled';
        $appointment->save();

        // Get all users with usertype 0 (patients)
        $patients = User::where('usertype', 0)->get();

        foreach ($patients as $patient) {
            $details = [
                'greeting' => 'Hello, ' . $patient->name,
                'body' => 'Your appointment has been cancelled. We are sorry for the inconvenience.',
                'actiontext' => 'View Appointment',
                'actionurl' => url('/'),
                'endpart' => 'Thank you for using Radiplus!'
            ];

            Notification::send($patient, new PatientAppointmentNotification($details));
        }

        return back()->with('message', 'Appointment cancelled and notifications sent.');
    }
    public static function notifyUsersOnReportReady(LabOrder $labOrder)
    {
        // Notify all patients
        $patients = User::where('usertype', 0)->get();
        foreach ($patients as $patient) {
            $details = [
                'greeting' => 'Hello, ' . $patient->name,
                'body' => 'Dear Patient, your report for ' . $labOrder->test_name . ' is ready.',
                'actiontext' => 'View Report',
                'actionurl' => url('/'),
                'endpart' => 'Thank you for using Radiplus!'
            ];

            Notification::send($patient, new PatientAppointmentNotification($details));
        }

        // Notify all doctors
        $doctors = User::where('usertype', 2)->get();
        foreach ($doctors as $doctor) {
            $details = [
                'greeting' => 'Hello, ' . $doctor->name,
                'body' => 'Dear Doctor, a report for ' . $labOrder->test_name . ' is ready.',
                'actiontext' => 'View Report',
                'actionurl' => url('/' . $labOrder->id),
                'endpart' => 'Thank you for using Radiplus!'
            ];

            Notification::send($doctor, new PatientAppointmentNotification($details));
        }
    }
}

