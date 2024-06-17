<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthenticationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [CustomAuthenticationController::class, 'loginUser'])->middleware('alreadyLoggedIn');
Route::get('/registration', [CustomAuthenticationController::class,'registration'])->middleware('alreadyLoggedIn');
Route::post('/register-user', [CustomAuthenticationController::class,'registerUser'])->name('register-user');
Route::post('/login-user', [CustomAuthenticationController::class, 'loginUser'])->name('login-user');
Route::match(['get', 'post'], 'forgot-password', [CustomAuthenticationController::class, 'forgotPassword'])->name('forgot-password');
Route::get('/activate/{token}', [CustomAuthenticationController::class, 'activateUser'])->name('activate');
Route::get('/logout', [CustomAuthenticationController::class,'logout']);

// Authenticated routes
Route::middleware(['isLoggedIn'])->group(function () {
    Route::get('/dashboard', [CustomAuthenticationController::class,'dashboard'])->name('dashboard');

    // Admin routes
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::patch('/admin/{user}/assign-role', [AdminController::class, 'assignRole'])->name('admin.assignRole');
        // Other admin routes
    });
});
