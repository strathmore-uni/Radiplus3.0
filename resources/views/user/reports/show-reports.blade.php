@extends('user.master')

@section('title')
View Reports
@endsection

@section('content')
<div class="container">
    <h1 class="text-center mb-5">View Your Reports</h1>
    <form class="main-form" action="{{ route('patient.getReports') }}" method="post">
        @csrf
        <div class="row mt-5">
            <div class="col-12 col-sm-6 py-2">
                <input type="text" class="form-control" placeholder="Enter your email" name="email" value="{{ old('email') }}">
                <span class="text-danger">
                    @error('email')
                        {{ $message }}
                    @enderror
                </span>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">View Reports</button>
    </form>

    @if(isset($reports) && $reports->count() > 0)
        <div class="mt-5">
            <h2 class="text-center">Your Reports</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Test Name</th>
                        <th>Price</th>
                        <th>Payment Status</th>
                        <th>Delivery Status</th>
                        <th>Radiology Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reports as $report)
                        <tr>
                            <td>{{ $report->test_name }}</td>
                            <td>{{ $report->price }}</td>
                            <td>{{ $report->payment_status }}</td>
                            <td>{{ $report->delivery_status }}</td>
                            <td>
                                @if($report->radiology_image)
                                    <img src="{{ asset('storage/'.$report->radiology_image) }}" alt="Radiology Image" style="max-width: 100px; max-height: 100px;">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('patient.printReport', $report->id) }}" class="btn btn-secondary">Print PDF</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @elseif(isset($email))
        <div class="mt-5">
            <h2 class="text-center">No reports found for the provided email: {{ $email }}</h2>
        </div>
    @endif
</div>
@endsection
