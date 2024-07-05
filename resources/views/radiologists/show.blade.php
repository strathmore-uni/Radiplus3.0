@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="{{ $radiologist->profile_picture ? asset('storage/' . $radiologist->profile_picture) : asset('images/default-profile.png') }}" class="card-img-top" alt="Profile Picture">
                    <div class="card-body">
                        <h2 class="card-title">{{ $radiologist->name }}</h2>
                        <p class="card-text">
                            <strong>Email:</strong> {{ $radiologist->email }}<br>
                            <strong>Specialty:</strong> {{ $radiologist->specialty }}<br>
                            <strong>Phone:</strong> {{ $radiologist->phone_number }}<br>
                            <strong>Address:</strong> {{ $radiologist->address }}<br>
                            <strong>About:</strong><br>
                            {{ $radiologist->about ?: 'No information provided.' }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <!-- Additional Details or Actions -->
            </div>
        </div>
        <a href="{{ route('radiologists.index') }}" class="btn btn-secondary">Back</a>
    </div>
@endsection
