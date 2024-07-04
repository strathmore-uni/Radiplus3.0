@extends('layouts.app')

@section('content')
    <h1>Create Patient</h1>
    <form action="{{ route('patients.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <button type="submit">Create</button>
    </form>
@endsection
