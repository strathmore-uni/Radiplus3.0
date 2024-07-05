@extends('layouts.app')
@section('title', 'Patients')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Patients</h1>
        <a href="{{ route('patients.create') }}" class="btn btn-primary mb-3">Create Patient</a>
        <ul class="list-group">
            @foreach($patients as $patient)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $patient->name }}</span>
                    <div>
                        <a href="{{ route('patients.show', $patient->id) }}" class="btn btn-info btn-sm me-2">View</a>
                        <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                        <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
