@extends('admin.master')
@section('title')
    @if (Auth::user()->usertype == 5)
        Add Report
    @else
        Add Tests
    @endif
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            <button data-dismiss="alert" type="button" class="close">&times;</button>
                            {{session()->get('message')}}
                        </div>
                    @endif
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4">
                            @if (Auth::user()->usertype == 5)
                                Add Report
                            @else
                                Add Tests
                            @endif
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ Auth::user()->usertype == 5 ? route('lab-order') : route('lab.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            @if (Auth::user()->usertype == 5)
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <input class="form-control" name="test_name" type="text" placeholder="Test Name" />
                                            <label for="test_name">Test Name</label>
                                            <span class="text-danger">
                                                @error('test_name')
                                                    {{$message}}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <input class="form-control" name="price" type="number" placeholder="Price" min="100" max="200" />
                                            <label for="price">Price (100-200)</label>
                                            <span class="text-danger">
                                                @error('price')
                                                    {{$message}}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <input class="form-control" name="name" type="text" placeholder="Customer Name" />
                                            <label for="name">Customer Name</label>
                                            <span class="text-danger">
                                                @error('name')
                                                    {{$message}}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <input class="form-control" name="email" type="email" placeholder="Email" />
                                            <label for="email">Email</label>
                                            <span class="text-danger">
                                                @error('email')
                                                    {{$message}}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <input class="form-control" name="phone" type="text" placeholder="Phone" />
                                            <label for="phone">Phone</label>
                                            <span class="text-danger">
                                                @error('phone')
                                                    {{$message}}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <input class="form-control" name="payment_status" type="text" placeholder="Payment Status" />
                                            <label for="payment_status">Payment Status</label>
                                            <span class="text-danger">
                                                @error('payment_status')
                                                    {{$message}}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <select class="form-control" name="delivery_status">
                                                <option value="Pending">Pending</option>
                                                <option value="Delivered">Delivered</option>
                                            </select>
                                            <label for="delivery_status">Delivery Status</label>
                                            <span class="text-danger">
                                                @error('delivery_status')
                                                    {{$message}}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <input class="form-control" name="radiology_image" type="file" />
                                            <label for="radiology_image">Radiology Image</label>
                                            <span class="text-danger">
                                                @error('radiology_image')
                                                    {{$message}}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <input class="form-control" name="name" type="text" placeholder="Test Name" />
                                            <label for="name">Test Name</label>
                                            <span class="text-danger">
                                                @error('name')
                                                    {{$message}}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <input class="form-control" id="inputPassword" name="code" type="text" placeholder="Code" required/>
                                            <label for="code">Code</label>
                                            <span class="text-danger">
                                                @error('code')
                                                    {{$message}}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <select class="form-control" id="inputRoom" name="room" required>
                                                <option value="" disabled selected>Select Room</option>
                                                @for ($i = 1; $i <= 10; $i++)
                                                    <option value="Room {{ $i }}" {{ old('room') == 'Room ' . $i ? 'selected' : '' }}>Room {{ $i }}</option>
                                                @endfor
                                            </select>
                                            <label for="inputRoom">Room No</label>
                                            <span class="text-danger">
                                                @error('room')
                                                    {{$message}}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <input class="form-control" id="inputPassword" value="{{old('description')}}" name="description" type="text" placeholder="Description" />
                                            <label for="description">Description</label>
                                            <span class="text-danger">
                                                @error('description')
                                                    {{$message}}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="mt-4 mb-0">
                                <input type="submit" class="btn btn-outline-success text-center" value="Add @if(Auth::user()->usertype == 5) Report @else Test @endif">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
