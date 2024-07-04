@extends('layouts.app')

@section('content')
    <h1>Edit Appointment</h1>
    <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ $appointment->name }}" required>
        <button type="submit">Update</button>
    </form>
@endsection
