@extends('layouts.app')

@section('content')
    <h1>Create Referral</h1>

    <form action="{{ route('referrals.store') }}" method="post">
        @csrf

        <div class="form-group">
            <label for="patient_id">Patient</label>
            <select name="patient_id" id="patient_id" class="form-control">
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="doctor_id">Doctor</label>
            <select name="doctor_id" id="doctor_id" class="form-control">
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="radiologist_id">Radiologist</label>
            <select name="radiologist_id" id="radiologist_id" class="form-control">
                @foreach($radiologists as $radiologist)
                    <option value="{{ $radiologist->id }}">{{ $radiologist->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="referral_date">Referral Date</label>
            <input type="date" name="referral_date" id="referral_date" class="form-control">
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" name="status" id="status" class="form-control">
        </div>

        <div class="form-group">
            <label for="imaging_exam_status">Imaging Exam Status</label>
            <input type="text" name="imaging_exam_status" id="imaging_exam_status" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Create Referral</button>
    </form>
@endsection