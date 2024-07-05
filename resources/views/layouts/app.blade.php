<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-dark" id="sidebar-wrapper">
            <div class="sidebar-heading text-center text-white">Admin Dashboard</div>
            <div class="list-group list-group-flush">
                <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action bg-dark text-white">Dashboard</a>
                <a href="{{ route('patients.index') }}" class="list-group-item list-group-item-action bg-dark text-white">Patients</a>
                <a href="{{ route('doctors.index') }}" class="list-group-item list-group-item-action bg-dark text-white">Doctors</a>
                <a href="{{ route('radiologists.index') }}" class="list-group-item list-group-item-action bg-dark text-white">Radiologists</a>
                <a href="{{ route('appointments.index') }}" class="list-group-item list-group-item-action bg-dark text-white">Appointments</a>
                <a href="{{ route('settings.index') }}" class="list-group-item list-group-item-action bg-dark text-white">Settings</a>
                <!-- Removed logout link from sidebar -->
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper" class="w-100">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <button class="navbar-toggler" id="menu-toggle" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand ml-4" href="#">Radiplus</a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Notifications
                            </a>
                            <div class="dropdown-menu dropdown-menu-right bg-dark" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item text-white" href="#">Action</a>
                                <a class="dropdown-item text-white" href="#">Another action</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="form-inline my-2 my-lg-0">
                                @csrf
                                <button class="btn btn-danger ml-2" type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="main-content container-fluid">
                @yield('content')
            </div>
        </div>
    </div>

    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
</body>
</html>
