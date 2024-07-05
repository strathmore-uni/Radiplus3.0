@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $appointment->patient_name }}'s Appointment</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Appointment Details</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Patient Name:</strong> {{ $appointment->patient_name }}</li>
                <li class="list-group-item"><strong>Patient Email:</strong> {{ $appointment->patient_email }}</li>
                <li class="list-group-item"><strong>Patient Phone:</strong> {{ $appointment->patient_phone }}</li>
                <li class="list-group-item"><strong>Appointment Date:</strong> {{ $appointment->appointment_date->format('M d, Y') }}</li>
                <li class="list-group-item"><strong>Appointment Time:</strong> {{ $appointment->appointment_time }}</li>
                <li class="list-group-item"><strong>Referring Doctor:</strong> {{ $appointment->referring_doctor }}</li>
                <li class="list-group-item"><strong>Radiologist:</strong> {{ $appointment->radiologist }}</li>
                <li class="list-group-item"><strong>Appointment Type:</strong> {{ $appointment->appointment_type }}</li>
                <li class="list-group-item"><strong>Status:</strong> {{ ucfirst($appointment->status) }}</li>
            </ul>
        </div>
    </div>

    <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-primary mt-3">Edit Appointment</a>
    <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" style="display: inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger mt-3" onclick="return confirm('Are you sure you want to delete this appointment?')">Delete Appointment</button>
    </form>
    <a href="{{ route('appointments.index') }}" class="btn btn-secondary mt-3">Back to Appointments</a>
</div>
@endsection
