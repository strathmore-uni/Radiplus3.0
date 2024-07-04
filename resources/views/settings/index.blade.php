@extends('layouts.app')

@section('content')
    <h1>Settings</h1>
    <a href="{{ route('settings.create') }}">Create Setting</a>
    <ul>
        @foreach($settings as $setting)
            <li>
                {{ $setting->name }}
                <a href="{{ route('settings.show', $setting->id) }}">View</a>
                <a href="{{ route('settings.edit', $setting->id) }}">Edit</a>
                <form action="{{ route('settings.destroy', $setting->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
