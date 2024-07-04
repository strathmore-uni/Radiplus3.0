@extends('layout')

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
        <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Back</a>
    </div>
@endsection
