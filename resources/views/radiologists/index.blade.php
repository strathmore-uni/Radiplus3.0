@extends('layouts.app')

@section('content')
    <h1>Radiologists</h1>

    <a href="{{ route('radiologists.create') }}">Create Radiologist</a>

    @if($radiologists->isEmpty())
        <p>No radiologists found.</p>
    @else
        <ul>
            @foreach($radiologists as $radiologist)
                <li>
                    {{ $radiologist->name }}
                    <a href="{{ route('radiologists.show', $radiologist->id) }}">View</a>
                    <a href="{{ route('radiologists.edit', $radiologist->id) }}">Edit</a>
                    <form action="{{ route('radiologists.destroy', $radiologist->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this radiologist?')">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
