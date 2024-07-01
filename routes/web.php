<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthenticationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\UserManagementController;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Authentication routes
Route::get('/login', [CustomAuthenticationController::class, 'login'])->name('login')->middleware('alreadyLoggedIn');
Route::post('/login', [CustomAuthenticationController::class, 'loginUser'])->name('login-user');
Route::get('/registration', [CustomAuthenticationController::class, 'registration'])->name('registration')->middleware('alreadyLoggedIn');
Route::post('/register-user', [CustomAuthenticationController::class, 'registerUser'])->name('register-user');
Route::match(['get', 'post'], '/forgot-password', [CustomAuthenticationController::class, 'forgotPassword'])->name('forgot-password');
Route::get('/activate/{token}', [CustomAuthenticationController::class, 'activateUser'])->name('activate');
Route::get('/logout', [CustomAuthenticationController::class, 'logout'])->name('logout');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Authenticated routes (requires login)
Route::get('/dashboard', function () {
    // Check if the user is authenticated
    if (auth()->check()) {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.index');
        } elseif ($user->hasRole('patient')) {
            return redirect()->route('patient.dashboard');
        } else {
            return view('dashboard');
        }
    } else {
        // Redirect to login if the user is not authenticated
        return redirect()->route('login')->with('error', 'Please log in to access the dashboard.');
    }
})->name('dashboard');


    // Profile management routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Admin routes (requires admin role)
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::patch('/assign-role/{user}', [AdminController::class, 'assignRole'])->name('assignRole');
        Route::get('/create-user', [AdminController::class, 'createUser'])->name('createUser');
        Route::post('/create-user', [AdminController::class, 'storeUser'])->name('storeUser');

        // User management routes
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [UserManagementController::class, 'index'])->name('index');
            Route::get('/{user}/edit', [UserManagementController::class, 'edit'])->name('edit');
            Route::post('/{user}/edit', [UserManagementController::class, 'update'])->name('update');
            Route::delete('/{user}', [UserManagementController::class, 'destroy'])->name('destroy');
        });
    });

    // Record management routes (available to radiologists and referring doctors)
    Route::middleware(['role:radiologist,referring_doctor'])->prefix('records')->name('records.')->group(function () {
        Route::get('/', [RecordController::class, 'index'])->name('index');
        Route::get('/create', [RecordController::class, 'create'])->name('create');
        Route::post('/', [RecordController::class, 'store'])->name('store');
        Route::get('/{record}', [RecordController::class, 'show'])->name('show');
        Route::delete('/{record}', [RecordController::class, 'destroy'])->name('destroy');
    });

    // Patient dashboard routes
    Route::middleware(['role:patient'])->group(function () {
        Route::get('/patient/dashboard', [DashboardController::class, 'index'])->name('patient.dashboard');
        // Add more patient-specific routes as needed
    });

