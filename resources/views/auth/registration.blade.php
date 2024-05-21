<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Radiplus</title>
    <link href="{{ asset('app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
    
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3" style="margin-top: 20px;">
                <h4>Welcome to Radiplus</h4> 
                <h5>Register here</h5>   
                <hr>
                <form action="{{ route('register-user') }}" method="post">
                    @csrf
                    @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>            
                    @endif
                    @if (Session::has('fail'))
                        <div class="alert alert-danger">{{ Session::get('fail') }}</div>            
                    @endif
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" class="form-control" placeholder="Enter Fullname" name="name" value="{{ old('name') }}">
                        <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email </label>
                        <input type="text" class="form-control" placeholder="Enter email" name="email" value="{{ old('email') }}">
                        <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" placeholder="Enter Password" name="password" value="">  
                        <span class="text-danger">@error('password'){{ $message }}@enderror</span>
    <small class="text-muted">Password must be at least 8 characters long ,include special characters(@,#,*).</small>
                    </div> 
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" value="">  
                        <span class="text-danger">@error('passwords'){{ $message }}@enderror</span>
                    </div> 
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" name="role">
                            <option value="">Select Role</option> <!-- Default option -->
                            <option value="doctor">Doctor</option>
                            <option value="patient">Patient</option>
                            <option value="radiologist">Radiologist</option>
                            <option value="admin">Admin</option>
                        </select>
                        <span class="text-danger">@error('role'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-block btn-primary" type="Submit">Register</button>
                    </div>
                    <br>
                    <a href="login">Have an account? Login here.</a>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
    crossorigin="anonymous"></script>
</html>
