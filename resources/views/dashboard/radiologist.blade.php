<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Radiologist Dashboard</title>
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
        <a class="navbar-brand" href="#">Radiologist Dashboard</a>
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
                        <li><a class="dropdown-item" href="#">New Referral Received</a></li>
                        <li><a class="dropdown-item" href="#">Report Submitted</a></li>
                        <li><a class="dropdown-item" href="#">Profile Updated Successfully</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout_url"><i class="fas fa-sign-out-alt"></i> Logout</a>
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
                    <img src="{{ asset('storage//' . $user->profile_picture) }}" alt="Profile Picture" class="img-fluid">
                    <h5>{{ $user->name }}</h5>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#analytics"><i class="fas fa-chart-pie"></i> Analytics</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#appointments"><i class="fas fa-calendar-check"></i> Appointments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#patients"><i class="fas fa-user-injured"></i> Patients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#profile"><i class="fas fa-user"></i> Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#notifications"><i class="fas fa-bell"></i> Notifications</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Content -->
        <div class="col-md-10 main-content">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Analytics</li>
                </ol>
            </nav>

            <!-- Analytics Section -->
            <section id="analytics">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Appointments</h5>
                                <canvas id="totalAppointmentsChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Patients</h5>
                                <canvas id="totalPatientsChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title">Upcoming Appointments</h5>
                        <ul class="list-group">
                            <li class="list-group-item">Date - Time with Patient Name</li>
                            <!-- Repeat for more appointments -->
                            <li class="list-group-item">No upcoming appointments.</li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- Other Sections -->
            <!-- Include your other sections like Appointments, Patients, Profile, and Notifications here -->

        </div>
    </div>
</div>

<!-- Footer -->
<footer class="text-center py-3">
    <p>&copy; 2023 Radiology Clinic</p>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
<script>
    // Dummy data for charts
    const totalAppointmentsData = {
        labels: ['January', 'February', 'March', 'April', 'May'],
        datasets: [{
            label: 'Total Appointments',
            data: [12, 19, 3, 5, 2],
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    };

    const totalPatientsData = {
        labels: ['January', 'February', 'March', 'April', 'May'],
        datasets: [{
            label: 'Total Patients',
            data: [8, 12, 5, 8, 3],
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    };

    // Total Appointments Chart
    var totalAppointmentsChart = document.getElementById('totalAppointmentsChart').getContext('2d');
    var myTotalAppointmentsChart = new Chart(totalAppointmentsChart, {
        type: 'bar',
        data: totalAppointmentsData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Total Patients Chart
    var totalPatientsChart = document.getElementById('totalPatientsChart').getContext('2d');
    var myTotalPatientsChart = new Chart(totalPatientsChart, {
        type: 'bar',
        data: totalPatientsData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist
