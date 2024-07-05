@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Appointments</h1>
        <a href="{{ route('appointments.create') }}" class="btn btn-primary mb-3">Create Appointment</a>

        @if ($appointments->isEmpty())
            <p>No appointments found.</p>
        @else
            <ul class="list-group">
                @foreach($appointments as $appointment)
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>{{ $appointment->patient_name }}</span>
                            <div>
                                <a href="{{ route('appointments.show', $appointment->id) }}" class="btn btn-sm btn-info mr-2">View</a>
                                <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                                <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this appointment?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
