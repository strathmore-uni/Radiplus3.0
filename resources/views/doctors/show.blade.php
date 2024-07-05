@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Doctor Details</h1>
        <div>
            <strong>Name:</strong> {{ $doctor->name }}
        </div>
        <div>
            <strong>Email:</strong> {{ $doctor->email }}
        </div>
        <div>
            <strong>Specialty:</strong> {{ $doctor->specialty }}
        </div>
        <div>
            <strong>Phone Number:</strong> {{ $doctor->phone_number }}
        </div>
        <div>
            <strong>Address:</strong> {{ $doctor->address }}
        </div>
        <div>
            <strong>About:</strong> {{ $doctor->about }}
        </div>
        <div>
            <strong>Profile Picture:</strong> 
            @if ($doctor->profile_picture)
                <img src="{{ asset('storage/' . $doctor->profile_picture) }}" alt="Profile Picture" style="max-width: 200px;">
            @else
                No profile picture available.
            @endif
        </div>
        <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Back</a>
    </div>
@endsection
