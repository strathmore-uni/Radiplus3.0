@extends('layouts.app')

@section('content')
    <h1>Edit Appointment</h1>
    <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="patient_name">Patient Name:</label>
            <input type="text" name="patient_name" id="patient_name" value="{{ $appointment->patient_name }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="patient_email">Patient Email:</label>
            <input type="email" name="patient_email" id="patient_email" value="{{ $appointment->patient_email }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="patient_phone">Patient Phone:</label>
            <input type="text" name="patient_phone" id="patient_phone" value="{{ $appointment->patient_phone }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="appointment_date">Appointment Date:</label>
            <input type="date" name="appointment_date" id="appointment_date" value="{{ $appointment->appointment_date }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="appointment_time">Appointment Time:</label>
            <input type="time" name="appointment_time" id="appointment_time" value="{{ $appointment->appointment_time }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="referring_doctor">Referring Doctor:</label>
            <input type="text" name="referring_doctor" id="referring_doctor" value="{{ $appointment->referring_doctor }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="radiologist">Radiologist:</label>
            <input type="text" name="radiologist" id="radiologist" value="{{ $appointment->radiologist }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="appointment_type">Appointment Type:</label>
            <input type="text" name="appointment_type" id="appointment_type" value="{{ $appointment->appointment_type }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <input type="text" name="status" id="status" value="{{ $appointment->status }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
