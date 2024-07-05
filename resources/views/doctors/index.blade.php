@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Doctors</h1>
        <a href="{{ route('doctors.create') }}" class="btn btn-primary">Add Doctor</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Specialty</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($doctors as $doctor)
                    <tr>
                        <td>{{ $doctor->name }}</td>
                        <td>{{ $doctor->email }}</td>
                        <td>{{ $doctor->specialty }}</td>
                        <td>
                            <a href="{{ route('doctors.show', $doctor->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this doctor?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
