@extends('layouts.app')

@section('content')
    <h1>Edit Setting</h1>
    <form action="{{ route('settings.update', $setting->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ $setting->name }}" required>
        <button type="submit">Update</button>
    </form>
@endsection
