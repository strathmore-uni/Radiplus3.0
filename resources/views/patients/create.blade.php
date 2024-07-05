@extends('layouts.app')

@section('content')
    <h1>Create Patient</h1>
    <form action="{{ route('patients.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <br><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <br><br>
        <label for="phone_number">Phone Number:</label>
        <input type="tel" name="phone_number" id="phone_number" required pattern="07[0-9]{8}" title="Kenyan phone number (07xxxxxxxx)">
        <br><br>
        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" name="date_of_birth" id="date_of_birth" required>
        <br><br>
        <label for="address">Address:</label>
        <textarea name="address" id="address" required></textarea>
        <br><br>
        <label for="medical_history">Medical History:</label>
        <textarea name="medical_history" id="medical_history" required></textarea>
        <br><br>
        <label for="gender">Gender:</label>
        <select name="gender" id="gender" required>
            <option value="">Select</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
        <br><br>
        <label for="profile_picture">Profile Picture:</label>
        <input type="file" name="profile_picture" id="profile_picture" required>
        <br><br>
        <label for="user_id">User ID:</label>
        <input type="number" name="user_id" id="user_id" required>
        <br><br>
        <button type="submit">Create</button>
    </form>
@endsection