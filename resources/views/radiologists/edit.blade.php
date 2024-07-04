@extends('layouts.app')

@section('content')
    <h1>Edit Radiologist</h1>
    <form action="{{ route('radiologists.update', $radiologist->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ $radiologist->name }}" required>
        <button type="submit">Update</button>
    </form>
@endsection
