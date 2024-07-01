<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Radiplus - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
          crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .profile-picture {
            width: 100px; /* Adjust size as needed */
            height: 100px; /* Adjust size as needed */
            border-radius: 50%; /* Make it circular */
            overflow: hidden; /* Hide overflow to ensure perfect circle */
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12" style="margin-top: 20px;">
            <h4>Welcome to your Dashboard</h4>
            <hr>
            @if($data)
                <div class="d-flex align-items-center">
                    <div class="profile-picture me-3">
                        @if($data->profile_picture && file_exists(public_path('storage/' . $data->profile_picture)))
                            <img src="{{ asset('storage/' . $data->profile_picture) }}" alt="Profile Picture" class="img-thumbnail">
                        @else
                            <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile Picture" class="img-thumbnail">
                        @endif
                    </div>
                    <div class="col-md-10">
                        <h1>Hello, {{ $data->name }}</h1>
                        <p>Your role(s): {{ $data->roles->pluck('name')->join(', ') }}</p>
                    </div>
                </div>
            @else
                <div class="alert alert-danger">
                    No user data available. Please log in again.
                </div>
            @endif
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
</html>
