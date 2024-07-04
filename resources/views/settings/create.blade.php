@extends('layouts.app')

@section('content')
    <h1>Create Setting</h1>
    <form action="{{ route('settings.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <button type="submit">Create</button>
    </form>
@endsection
