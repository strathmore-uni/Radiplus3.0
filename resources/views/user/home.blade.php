@extends('user.master')

@section('title')
Home
@endsection

@section('content')
@if(session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ session()->get('message') }}
    </div>
@endif
@if(session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ session()->get('error') }}
    </div>
@endif
<div class="page-hero bg-image overlay-dark" style="background-image: url({{asset('assets')}}/img/bg_image_1.jpg);">
    <div class="hero-section">
        <div class="container text-center wow zoomIn">
            <span class="subhead">Let's streamline radiology</span>
            <h1 class="display-4">Healthy Living</h1>
            
        </div>
    </div>
</div>

<div class="bg-light">
    <div class="page-section py-3 mt-md-n5 custom-index">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4 py-3 py-md-0">
                    <div class="card-service wow fadeInUp">
                        <div class="circle-shape bg-secondary text-white">
                            <span class="mai-chatbubbles-outline"></span>
                        </div>
                        <p><span>Get your</span> reports</p>
                    </div>
                </div>
                <div class="col-md-4 py-3 py-md-0">
                    <div class="card-service wow fadeInUp">
                        <div class="circle-shape bg-primary text-white">
                            <span class="mai-shield-checkmark"></span>
                        </div>
                        <p><span>Radiplus</span>-Health Protection</p>
                    </div>
                </div>
                <div class="col-md-4 py-3 py-md-0">
                    <div class="card-service wow fadeInUp">
                        <div class="circle-shape bg-accent text-white">
                            <span class="mai-basket"></span>
                        </div>
                        <p><span>Radi</span>-Plus </p>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- .page-section -->

    <div class="page-section pb-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 py-3 wow fadeInUp">
                    <h1>Welcome to <br> Radiplus</h1>
                    <p class="text-grey mb-4"> Radiplus is a cutting-edge radiology information system designed to
                        streamline the workflow of radiology departments within healthcare institutions. Our platform
                        provides a comprehensive suite of tools for managing patient appointments, radiology requests,
                        image uploads, and result dissemination. With Radiplus, doctors can effortlessly request and
                        review radiological exams, radiologists can efficiently manage and interpret imaging studies,
                        and patients can conveniently access and print their radiology results. By integrating
                        seamlessly with existing hospital management systems, Radiplus enhances communication and
                        collaboration among healthcare professionals, ensuring timely and accurate diagnostic services.
                        Our commitment is to improve the efficiency and effectiveness of radiology departments,
                        ultimately contributing to better patient outcomes and a more robust healthcare system.

                    </p>
                    <a href="{{route('about')}}" class="btn btn-primary">Learn More</a>
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="400ms">
                    <div class="img-place custom-img-1">
                        <img src="{{asset('assets')}}/img/bg-doctor.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- .bg-light -->
</div> <!-- .bg-light -->

<div class="page-section">
    <div class="container">
        <h1 class="text-center mb-5 wow fadeInUp">Our Doctors</h1>

        <div class="owl-carousel wow fadeInUp justify-content-center" id="doctorSlideshow">
            @foreach($doctor as $doctors)
                <div class="item">
                    <div class="card-doctor">
                        <div class="header">
                            <img src="{{$doctors->image}}" alt="" style="height: 250px !important;">
                            <div class="meta">
                                <a href="#"><span class="mai-call"></span></a>
                                <a href="#"><span class="mai-logo-whatsapp"></span></a>
                            </div>
                        </div>
                        <div class="body">
                            <h5><a href="{{route('doctor-details', ['id' => $doctors->id])}}">{{$doctors->name}}</a></h5>
                            <span class="text-sm text-grey" style="color: red;">{{$doctors->speciality}}</span>
                            <div>
                                <h3>Consultant Fee: {{$doctors->fee}}/=</h3>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="page-section">
    <div class="container">
        <h1 class="text-center wow fadeInUp" id="appointmentForm">Make an Appointment</h1>

        <form class="main-form" action="{{route('appointment')}}" method="post">
            @csrf
            <div class="row mt-5 ">
                <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
                    <input type="text" class="form-control" placeholder="Full name" name="name" value="{{old('name')}}">
                    <span class="text-danger">
                        @error('name')
                            {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="col-12 col-sm-6 py-2 wow fadeInRight">
                    <input type="text" name="email" class="form-control" placeholder="Email address.."
                        value="{{old('email')}}">
                    <span class="text-danger">
                        @error('email')
                            {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
                    <input type="date" class="form-control" name="date" id="appointmentDate" min="" max="">
                    <span class="text-danger">
                        @error('date')
                            {{ $message }}
                        @enderror
                    </span>
                    <span class="text-warning" id="dateWarning" style="display: none;">Please select a future
                        date.</span>
                </div>


                <div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
                    <select name="doctor" id="doctorDropdown" class="custom-select">
                        <option value="">-- Select Doctors --</option>
                        @foreach($doctor as $doctors)
                            <option value="{{ $doctors->id }}" doc_id="{{ $doctors->id }}" data-fee="{{ $doctors->fee }}">
                                {{ $doctors->name }} -- Speciality -- {{ $doctors->speciality }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
                    <input type="text" name="fee" id="feeInput" class="form-control" placeholder="Fee.."
                        value="{{ old('fee') }}" readonly>
                    <input type="hidden" value="{{old('doctor_id')}}" name="doctor_id" id="doctorIdInput" readonly>
                    <span class="text-danger">
                        @error('fee')
                            {{ $message }}
                        @enderror
                    </span>
                </div>


                <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
                    <input type="text" name="phone" class="form-control" placeholder="Number.."
                        value="{{old('phone')}}">
                    <span class="text-danger">
                        @error('phone')
                            {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
                    <textarea name="message" id="message" class="form-control" rows="6"
                        placeholder="Enter message.."></textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3 wow zoomIn btn-home"
                style="background-color: #00D9A5 ;">Submit Request</button>
        </form>
    </div>
</div> <!-- .page-section -->

<div class="page-section">
    <div class="container">
        <h1 class="text-center wow fadeInUp">View Your Reports</h1>

        <form class="main-form" action="{{ route('patient.getReports') }}" method="post">
            @csrf
            <div class="row mt-5 ">
                <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
                    <input type="text" class="form-control" placeholder="Enter your email" name="email" value="{{old('email')}}">
                    <span class="text-danger">
                        @error('email')
                            {{$message}}
                        @enderror
                    </span>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3 wow zoomIn btn-home"
                style="background-color: #00D9A5 ;">View Reports</button>
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
</div> <!-- .page-section -->

<div class="page-section banner-home bg-image"
    style="background-image: url({{asset('assets')}}/img/banner-pattern.svg);">
    <div class="container py-5 py-lg-0">
        <div class="row align-items-center">
            <div class="col-lg-4 wow zoomIn">
                <div class="img-banner d-none d-lg-block">
                    <img src="{{asset('assets')}}/img/mobile_app.png" alt="">
                </div>
            </div>
            <div class="col-lg-8 wow fadeInRight">
                <h1 class="font-weight-normal mb-3">Get easy access of all features upcoming Radiplus App</h1>
                <a href="#"><img src="{{asset('assets')}}/img/google_play.svg" alt=""></a>
                <a href="#" class="ml-2"><img src="{{asset('assets')}}/img/app_store.svg" alt=""></a>
            </div>
        </div>
    </div>
</div> <!-- .banner-home -->

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const doctorDropdown = document.getElementById("doctorDropdown");
        const feeInput = document.getElementById("feeInput");
        const doctorIdInput = document.getElementById("doctorIdInput");

        doctorDropdown.addEventListener("change", function () {
            const selectedOption = doctorDropdown.options[doctorDropdown.selectedIndex];
            const selectedFee = selectedOption.getAttribute("data-fee");
            const selectedDoctorId = selectedOption.value;

            feeInput.value = selectedFee || ""; // Set the fee input value
            doctorIdInput.value = selectedDoctorId; // Set the selected doctor's ID
        });
        const currentDate = new Date();
        const currentMonth = currentDate.getMonth();
        const currentYear = currentDate.getFullYear();

        const startDate = new Date(currentYear, currentMonth, 1);
        const endDate = new Date(currentYear, currentMonth + 1, 0);

        const appointmentDateInput = document.getElementById('appointmentDate');
        appointmentDateInput.min = startDate.toISOString().slice(0, 10);
        appointmentDateInput.max = endDate.toISOString().slice(0, 10);
    });
</script>
@endsection
