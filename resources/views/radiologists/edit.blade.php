@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Radiologist</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('radiologists.update', $radiologist->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $radiologist->name }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $radiologist->email }}" required>
            </div>

            <div class="form-group">
                <label for="specialty">Specialty:</label>
                <select class="form-control" id="specialty" name="specialty" required>
                    <option value="MRI" {{ $radiologist->specialty === 'MRI' ? 'selected' : '' }}>MRI</option>
                    <option value="X-ray" {{ $radiologist->specialty === 'X-ray' ? 'selected' : '' }}>X-ray</option>
                    <option value="Ultrasound" {{ $radiologist->specialty === 'Ultrasound' ? 'selected' : '' }}>Ultrasound</option>
                    <option value="CT Scan" {{ $radiologist->specialty === 'CT Scan' ? 'selected' : '' }}>CT Scan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $radiologist->phone_number }}" pattern="[0-9]{3} [0-9]{3} [0-9]{4}" placeholder="Format: 123 456 7890" required>
                <small class="text-muted">Format: 123 456 7890 (Kenyan format)</small>
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $radiologist->address }}">
            </div>

            <div class="form-group">
                <label for="about">About:</label>
                <textarea class="form-control" id="about" name="about" rows="3">{{ $radiologist->about }}</textarea>
            </div>

            <div class="form-group">
                <label for="profile_picture">Profile Picture:</label>
                <input type="file" class="form-control-file" id="profile_picture" name="profile_picture">
                @if ($radiologist->profile_picture)
                    <img src="{{ asset('storage/' . $radiologist->profile_picture) }}" alt="Profile Picture" style="max-width: 200px; margin-top: 10px;">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
