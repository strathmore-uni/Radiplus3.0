@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Radiologist</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('radiologists.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>

            <div class="form-group">
                <label for="specialty">Specialty</label>
                <select class="form-control" id="specialty" name="specialty" required>
                    <option value="Radiology">Radiology</option>
                    <option value="Diagnostic Radiology">Diagnostic Radiology</option>
                    <option value="Interventional Radiology">Interventional Radiology</option>
                    <option value="Nuclear Radiology">Nuclear Radiology</option>
                </select>
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="tel" class="form-control" id="phone_number" name="phone_number" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" placeholder="Format: 123456789" required>
                <small class="form-text text-muted">Format: 123456789</small>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control" id="address" name="address" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="about">About</label>
                <textarea class="form-control" id="about" name="about" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="profile_picture">Profile Picture</label>
                <input type="file" class="form-control-file" id="profile_picture" name="profile_picture">
            </div>

            <button type="submit" class="btn btn-primary">Create Radiologist</button>
        </form>
    </div>
@endsection
