<?php
namespace App\Http\Controllers;

use App\Models\Referral;
use App\Models\Patient;
use App\Models\Doctor;  
use App\Models\Radiologist;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    public function index()
    {
        $referrals = Referral::all();
        return view('referrals.index', compact('referrals'));
    }

    public function create()
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        $radiologists = Radiologist::all();
        return view('referrals.create', compact('patients', 'doctors', 'radiologists'));
    }

    public function store(Request $request)
    {
        $referral = new Referral();
        $referral->patient_id = $request->input('patient_id');
        $referral->doctor_id = $request->input('doctor_id');
        $referral->radiologist_id = $request->input('radiologist_id');
        $referral->referral_date = $request->input('referral_date');
        $referral->status = $request->input('status');
        $referral->imaging_exam_status = $request->input('imaging_exam_status');
        $referral->save();
        return redirect()->route('referrals.index');
    }

    public function show(Referral $referral)
    {
        return view('referrals.show', compact('referral'));
    }

    public function edit(Referral $referral)
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        $radiologists = Radiologist::all();
        return view('referrals.edit', compact('referral', 'patients', 'doctors', 'radiologists'));
    }

    public function update(Request $request, Referral $referral)
    {
        $referral->patient_id = $request->input('patient_id');
        $referral->doctor_id = $request->input('doctor_id');
        $referral->radiologist_id = $request->input('radiologist_id');
        $referral->referral_date = $request->input('referral_date');
        $referral->status = $request->input('status');
        $referral->imaging_exam_status = $request->input('imaging_exam_status');
        $referral->save();
        return redirect()->route('referrals.index');
    }

    public function destroy(Referral $referral)
    {
        $referral->delete();
        return redirect()->route('referrals.index');
    }
}