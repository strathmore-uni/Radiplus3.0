@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">{{ $patient->name }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img src="{{ asset('storage/' . $patient->profile_picture) }}" alt="{{ $patient->name }}" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px;">
                        </div>
                        <div class="col-md-8">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>User ID:</strong> {{ $patient->user_id }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Email:</strong> {{ $patient->email }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Phone Number:</strong> {{ $patient->phone_number }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Date of Birth:</strong> {{ $patient->date_of_birth }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Address:</strong> {{ $patient->address }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Medical History:</strong> {{ $patient->medical_history }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Gender:</strong> {{ $patient->gender }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('patients.index') }}" class="btn btn-secondary">Back to Patients List</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
