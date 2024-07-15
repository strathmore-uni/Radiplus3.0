@extends('admin.master')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4" style="font-size: 35px;font-weight: 600;">Dashboard</h1>
        <ol class="breadcrumb mb-4">
           
        </ol>

        @if(Auth::user()->usertype == 1) {{-- Admin Dashboard --}}
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Patients:100</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">Doctors:21</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Reports</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">Lab</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Radiplus Area Chart 
                        </div>
                        <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar me-1"></i>
                            Radiplus Bar Chart
                        </div>
                        <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Top Doctors
                    <div class="d-flex justify-content-end" style="margin-top: -20px;"><a href="{{ route('doctor.index') }}" class="btn btn-primary">Manage Doctor</a></div>
                </div>
                @endif {{-- Close the @if block --}}

                @if(Auth::user()->usertype == 5) {{-- Radiologist Dashboard --}}
    <div class="row">
    <div class="card-header">
                    <i class="fas fa-hospital me-1"></i>
                    Welcome to the Radiology Lab
                </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Patients: 10</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Reports</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">Lab</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                  
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-4">
              
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="#"><img src="{{ asset('assets/img/broken.jpeg') }}" class="img-fluid" alt="Image 1 Label"></a>
                            <p class="text-center">X-Ray 01 </p>
                        </div>
                        <div class="col-md-4">
                            <a href="#"><img src="assets/img/scan.jpeg" class="img-fluid" alt="Image 2 Label"></a>
                            <p class="text-center">X-Ray 02</p>
                        </div>
                        <div class="col-md-4">
                            <a href="#"><img src="assets/img/chest.jpeg" class="img-fluid" alt="Image 3 Label"></a>
                            <p class="text-center">X-Ray 03 </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif {{-- Close the @if block --}}


@if(Auth::user()->usertype == 2) {{-- Doctor Dashboard --}}
    <div class="row">
    <div class="card-header">
                    <i class="fas fa-hospital me-1"></i>
                    Welcome Doctor
                </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Patients: 10</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Pending Reports : 2</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">Appointments</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                  
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-4">
              
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="#"><img src="{{ asset('assets/img/broken.jpeg') }}" class="img-fluid" alt="Image 1 Label"></a>
                            <p class="text-center">Patient 01 </p>
                        </div>
                        <div class="col-md-4">
                            <a href="#"><img src="assets/img/scan.jpeg" class="img-fluid" alt="Image 2 Label"></a>
                            <p class="text-center">Patient 02</p>
                        </div>
                        <div class="col-md-4">
                            <a href="#"><img src="assets/img/chest.jpeg" class="img-fluid" alt="Image 3 Label"></a>
                            <p class="text-center">Patient 03 </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif {{-- Close the @if block --}}
                
                @endsection
                