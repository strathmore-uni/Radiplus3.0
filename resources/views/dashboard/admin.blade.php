<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            background-color: #343a40;
            height: 100vh;
            padding-top: 20px;
            color: white;
        }
        .sidebar .profile {
            text-align: center;
            margin-bottom: 30px;
        }
        .sidebar .profile img {
            border-radius: 50%;
            width: 80px;
            height: 80px;
            object-fit: cover;
        }
        .sidebar .profile h5 {
            margin-top: 10px;
            font-size: 16px;
            color: #ffffff;
        }
        .sidebar .nav-link {
            color: #adb5bd;
            font-size: 14px;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            color: #ffffff;
            background-color: #495057;
        }
        .main-content {
            padding: 20px;
            background-color: #ffffff;
            min-height: 100vh;
        }
        .breadcrumb {
            background-color: transparent;
        }
        .navbar {
            background-color: #343a40;
            color: #ffffff;
        }
        .navbar .navbar-brand, .navbar .nav-link {
            color: #ffffff;
        }
        .navbar .nav-link:hover {
            color: #adb5bd;
        }
        .navbar .dropdown-menu {
            background-color: #495057;
            color: #ffffff;
        }
        .navbar .dropdown-item {
            color: #ffffff;
        }
        .navbar .dropdown-item:hover {
            background-color: #343a40;
        }
        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Admin Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="notificationsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bell"></i> Notifications
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationsDropdown">
                        <li><a class="dropdown-item" href="#">New Appointment Scheduled</a></li>
                        <li><a class="dropdown-item" href="#">Profile Updated Successfully</a></li>
                        <li><a class="dropdown-item" href="#">System Maintenance Notification</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2">
            <div class="sidebar">
                <div class="profile">
                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="img-fluid">
                    <h5>{{ $user->name }}</h5>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.patients') }}"><i class="fas fa-user-injured"></i> Patients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.doctors') }}"><i class="fas fa-user-md"></i> Doctors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.radiologists') }}"><i class="fas fa-x-ray"></i> Radiologists</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.appointments') }}"><i class="fas fa-calendar-check"></i> Appointments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.settings') }}"><i class="fas fa-cogs"></i> Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Content -->
        <div class="col-md-10 main-content">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>

            <!-- Analytics Section as Landing Page -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Analytics Overview</h5>
                            <p class="card-text">Here are some analytics data and charts.</p>
                            <canvas id="analyticsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dummy Features Section -->
            <div class="row">
                <!-- Calendar -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Calendar</h5>
                            <p class="card-text">Here you can view upcoming events and appointments.</p>
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Recent Activities</h5>
                            <ul class="list-group">
                                <li class="list-group-item">User John Doe added a new appointment.</li>
                                <li class="list-group-item">Patient record updated for Jane Smith.</li>
                                <li class="list-group-item">System settings changed by Admin.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
<script>
    // Dummy data for the analytics chart
    const ctx = document.getElementById('analyticsChart').getContext('2d');
    const analyticsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'Patients',
                data: [10, 20, 30, 40, 50, 60, 70],
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                fill: false
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Dummy calendar initialization
    const calendarEl = document.getElementById('calendar');
    calendarEl.innerHTML = 'Calendar goes here... (Add calendar integration as needed)';
</script>
</body>
</html>
