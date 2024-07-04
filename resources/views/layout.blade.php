<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Admin</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('appointments.index') }}">Appointments</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('doctors.index') }}">Doctors</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('patients.index') }}">Patients</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('radiologists.index') }}">Radiologists</a></li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>
