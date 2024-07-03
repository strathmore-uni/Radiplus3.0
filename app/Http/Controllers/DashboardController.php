<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View; // Example model import if needed

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $userEmail = $request->session()->get('loginEmail');
        //die($userId);
        if ($userEmail) {
            $user = User::where('email', $userEmail)->first();
            //dd($user);
            $userRole = $user->role;

            switch ($userRole) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                    break;
                case 'patient':
                    return redirect()->route('patient.dashboard');
                    break;
                case 'radiologist':
                    return redirect()->route('radiologist.dashboard');
                    break;
                case 'doctor':
                    return redirect()->route('doctor.dashboard');
                    break;
                default:
                    return redirect()->route('patient.dashboard');
            }

        }

        return redirect()->route('logout');
    }

    public function admin(Request $request)
    {
        $userEmail = $request->session()->get('loginEmail');
        $user = User::where('email', $userEmail)->first();
        return view("dashboard.admin", ['user' => $user]);
    }

    public function patient(Request $request)
    {
        $userEmail = $request->session()->get('loginEmail');
        $user = User::where('email', $userEmail)->first();
        return view("dashboard.patient", ['user' => $user]);
    }

    public function doctor(Request $request)
    {
        $userEmail = $request->session()->get('loginEmail');
        $user = User::where('email', $userEmail)->first();
        return view("dashboard.doctor", [
            'user' => $user,
            'patients' => [],
            'referrals' => []
        ]);
    }

    public function radiologist(Request $request)
    {
        $userEmail = $request->session()->get('loginEmail');
        $user = User::where('email', $userEmail)->first();
        return view("dashboard.radiologist", [
            'user' => $user
        ]);
    }
}
