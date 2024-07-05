@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Doctor</h1>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('doctors.update', $doctor->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $doctor->name }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $doctor->email }}" required>
            </div>

            <div class="form-group">
                <label for="specialty">Specialty</label>
                <select class="form-control" id="specialty" name="specialty" required>
                    <option value="Radiologist" @if ($doctor->specialty == 'Radiologist') selected @endif>Radiologist</option>
                    <option value="Oncologist" @if ($doctor->specialty == 'Oncologist') selected @endif>Oncologist</option>
                    <option value="Cardiologist" @if ($doctor->specialty == 'Cardiologist') selected @endif>Cardiologist</option>
                    <option value="Neurologist" @if ($doctor->specialty == 'Neurologist') selected @endif>Neurologist</option>
                    <!-- Add more options as needed -->
                </select>
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $doctor->phone_number }}" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" placeholder="Format: XXXXXXXXXXXX" required>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $doctor->address }}" required>
            </div>

            <div class="form-group">
                <label for="about">About</label>
                <textarea class="form-control" id="about" name="about">{{ $doctor->about }}</textarea>
            </div>

            <div class="form-group">
                <label for="profile_picture">Profile Picture</label>
                <input type="file" class="form-control-file" id="profile_picture" name="profile_picture">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
