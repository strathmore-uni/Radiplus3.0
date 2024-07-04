@extends('layouts.app')

@section('content')
    <h1>Patients</h1>
    <a href="{{ route('patients.create') }}">Create Patient</a>
    <ul>
        @foreach($patients as $patient)
            <li>
                {{ $patient->name }}
                <a href="{{ route('patients.show', $patient->id) }}">View</a>
                <a href="{{ route('patients.edit', $patient->id) }}">Edit</a>
                <form action="{{ route('patients.destroy', $patient->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
