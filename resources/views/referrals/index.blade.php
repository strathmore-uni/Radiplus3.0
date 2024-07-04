@extends('layouts.app')

@section('content')
    <h1>Referrals</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Patient</th>
                <th>Doctor</th>
                <th>Radiologist</th>
                <th>Referral Date</th>
                <th>Status</th>
                <th>Imaging Exam Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($referrals as $referral)
                <tr>
                    <td>{{ $referral->patient->name }}</td>
                    <td>{{ $referral->doctor->name }}</td>
                    <td>{{ $referral->radiologist->name }}</td>
                    <td>{{ $referral->referral_date }}</td>
                    <td>{{ $referral->status }}</td>
                    <td>{{ $referral->imaging_exam_status }}</td>
                    <td>
                        <a href="{{ route('referrals.show', $referral->id) }}" class="btn btn-primary">View</a>
                        <a href="{{ route('referrals.edit', $referral->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('referrals.destroy', $referral->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('referrals.create') }}" class="btn btn-success">Create New Referral</a>
@endsection