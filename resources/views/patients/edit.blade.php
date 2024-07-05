@extends('layouts.app')

@section('content')
    <h1>Edit Patient</h1>
    <form action="{{ route('patients.update', $patient->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ $patient->name }}" required>
        <br><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="{{ $patient->email }}" required>
        <br><br>
        <label for="phone_number">Phone Number:</label>
        <input type="tel" name="phone_number" id="phone_number" value="{{ $patient->phone_number }}" required pattern="[0-9]{10}" placeholder="07xxxxxxxx">
        <br><br>
        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" name="date_of_birth" id="date_of_birth" value="{{ $patient->date_of_birth }}" required>
        <br><br>
        <label for="address">Address:</label>
        <input type="text" name="address" id="address" value="{{ $patient->address }}" required>
        <br><br>
        <label for="medical_history">Medical History:</label>
        <textarea name="medical_history" id="medical_history" required>{{ $patient->medical_history }}</textarea>
        <br><br>
        <label for="gender">Gender:</label>
        <select name="gender" id="gender" required>
            <option value="Male" @if($patient->gender == 'Male') selected @endif>Male</option>
            <option value="Female" @if($patient->gender == 'Female') selected @endif>Female</option>
        </select>
        <br><br>
        <label for="profile_picture">Profile Picture:</label>
        <input type="file" name="profile_picture" id="profile_picture">
        <br><br>
        <button type="submit">Update</button>
    </form>
@endsection