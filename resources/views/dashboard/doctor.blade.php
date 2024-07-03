<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
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
        <a class="navbar-brand" href="#">Doctor Dashboard</a>
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
                        <li><a class="dropdown-item" href="#">Referral Status Updated</a></li>
                        <li><a class="dropdown-item" href="#">Profile Updated Successfully</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
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
                        <a class="nav-link active" href="#referrals"><i class="fas fa-file-medical"></i> Referrals</a>
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
                    <li class="nav-item">
                        <a class="nav-link" href="#analytics"><i class="fas fa-chart-bar"></i> Analytics</a>
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

            <!-- Referrals Section -->
            <section id="referrals">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Patient Referrals</h5>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Patient Name</th>
                                <th>Referral Date</th>
                                <th>Radiologist Assigned</th>
                                <th>Referral Status</th>
                            </tr>
                            </thead>
                            <tbody>
                           @foreach ($referrals as $referral) { ?>
                            <tr>
                                <td><?= $referral['patient_name']?></td>
                                <td><?= $referral['referral_date']?></td>
                                <td><?= $referral['radiologist_name']?></td>
                                <td><?= $referral['status']?></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- Patients Section -->
            <section id="patients">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Patients</h5>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Patient Name</th>
                                <th>Medical Information</th>
                                <th>Last Visit</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($patients as $patient) { ?>
                            <tr>
                                <td><?= $patient['name']?></td>
                                <td><?= $patient['medical_info']?></td>
                                <td><?= $patient['last_visit']?></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- Profile Section -->
            <section id="profile">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Profile</h5>
                        <form>
                            <div class="mb-3">
                                <label for="profile_picture" class="form-label">Profile Picture:</label>
                                <input type="file" id="profile_picture" name="profile_picture" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" id="email" name="email" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm Password:</label>
                                <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </form>
                    </div>
                </div>
            </section>

            <!-- Notifications Section -->
            <section id="notifications">
                <div class="card">
                    <div class="card-body
