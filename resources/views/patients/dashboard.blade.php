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
            @yield('dashboard_content')
        </div>
    </div>
</div>
@endsection
