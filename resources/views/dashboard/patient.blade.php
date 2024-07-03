<!-- patient/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <!-- Sidebar -->
                <ul class="list-group">
                    <li class="list-group-item"><a href="{{ route('patient.dashboard') }}">Dashboard</a></li>
                    <li class="list-group-item"><a href="{{ route('patient.profile') }}">Profile</a></li>
                    <li class="list-group-item"><a href="{{ route('patient.appointments') }}">Appointments</a></li>
                    <!-- Add more sidebar links as needed -->
                </ul>
            </div>
            <div class="col-md-9">
                <!-- Main Content -->
                <div class="row">
                    <div class="col-md-4">
                        <!-- Profile Picture and Name -->
                        <div class="card">
                            <div class="card-body">
                                <img src="{{ asset('storage/'. $user->profile_picture) }}" alt="Profile Picture" class="img-fluid">
                                <h5>{{ $user->name }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <!-- Upcoming Appointments -->
                        <div class="card">
                            <div class="card-body">
                                <h5>Upcoming Appointments</h5>
                                <ul>
                                    {{-- @foreach($user->upcomingAppointments as $appointment)
                                        <li>
                                            {{ $appointment->date }} - {{ $appointment->time }} with {{ $appointment->doctor->name }}
                                        </li>
                                    @endforeach--}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Appointment History -->
                        <div class="card">
                            <div class="card-body">
                                <h5>Appointment History</h5>
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Doctor</th>
                                        <th>Details</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {{-- @foreach(auth()->user()->appointmentHistory as $appointment)
                                        <tr>
                                            <td>{{ $appointment->date }}</td>
                                            <td>{{ $appointment->time }}</td>
                                            <td>{{ $appointment->doctor->name }}</td>
                                            <td>{{ $appointment->details }}</td>
                                        </tr>
                                    @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Medical Records -->
                        <div class="card">
                            <div class="card-body">
                                <h5>Medical Records</h5>
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Medication</th>
                                        <th>Details</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {{-- @foreach(auth()->user()->medicalRecords as $record)
                                        <tr>
                                            <td>{{ $record->date }}</td>
                                            <td>{{ $record->medication }}</td>
                                            <td>{{ $record->details }}</td>
                                        </tr>
                                    @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


