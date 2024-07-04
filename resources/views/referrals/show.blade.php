@extends('layouts.app')

@section('content')
    <h1>Referral {{ $referral->id }}</h1>

    <p>Patient: {{ $referral->patient->name }}</p>
    <p>Doctor: {{ $referral->doctor->name }}</p>
    <p>Radiologist: {{ $referral->radiologist->name }}</p>
    <p>Referral Date: {{ $referral->referral_date }}</p>
    <p>Status: {{ $referral->status }}</p>
    <p>Imaging Exam Status: {{ $referral->imaging_exam_status }}</p>

    <a href="{{ route('referrals.index') }}" class="btn btn-secondary">Back to Referrals</a>
@endsection