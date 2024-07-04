@extends('layouts.app')

@section('content')
    <h1>Edit Patient</h1>
    <form action="{{ route('patients.update', $patient->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ $patient->name }}" required>
        <button type="submit">Update</button>
    </form>
@endsection
