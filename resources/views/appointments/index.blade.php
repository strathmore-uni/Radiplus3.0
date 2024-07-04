@extends('layouts.app')

@section('content')
    <h1>Appointments</h1>
    <a href="{{ route('appointments.create') }}">Create Appointment</a>
    <ul>
        @foreach($appointments as $appointment)
            <li>
                {{ $appointment->name }}
                <a href="{{ route('appointments.show', $appointment->id) }}">View</a>
                <a href="{{ route('appointments.edit', $appointment->id) }}">Edit</a>
                <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
