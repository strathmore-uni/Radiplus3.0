@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Appointment</h1>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('appointments.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="patient_name">Patient Name</label>
                <input type="text" class="form-control" id="patient_name" name="patient_name" value="{{ old('patient_name') }}" required>
            </div>

            <div class="form-group">
                <label for="patient_email">Patient Email</label>
                <input type="email" class="form-control" id="patient_email" name="patient_email" value="{{ old('patient_email') }}" required>
            </div>

            <div class="form-group">
                <label for="patient_phone">Patient Phone Number</label>
                <input type="text" class="form-control" id="patient_phone" name="patient_phone" value="{{ old('patient_phone') }}" required>
            </div>

            <div class="form-group">
                <label for="appointment_date">Appointment Date</label>
                <input type="date" class="form-control" id="appointment_date" name="appointment_date" value="{{ old('appointment_date') }}" required>
            </div>

            <div class="form-group">
                <label for="appointment_time">Appointment Time</label>
                <input type="time" class="form-control" id="appointment_time" name="appointment_time" value="{{ old('appointment_time') }}" required>
            </div>

            <div class="form-group">
                <label for="referring_doctor">Referring Doctor</label>
                <input type="text" class="form-control" id="referring_doctor" name="referring_doctor" value="{{ old('referring_doctor') }}" required>
            </div>

            <div class="form-group">
                <label for="radiologist">Radiologist</label>
                <input type="text" class="form-control" id="radiologist" name="radiologist" value="{{ old('radiologist') }}" required>
            </div>

            <div class="form-group">
                <label for="appointment_type">Appointment Type</label>
                <select class="form-control" id="appointment_type" name="appointment_type" required>
                    <option value="MRI">MRI</option>
                    <option value="X-ray">X-ray</option>
                    <option value="Ultrasound">Ultrasound</option>
                    <option value="CT Scan">CT Scan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create Appointment</button>
        </form>
    </div>
@endsection
