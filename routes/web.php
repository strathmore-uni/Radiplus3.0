<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthenticationController;

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
Route::get('/login', [CustomAuthenticationController::class, 'login'])->middleware('alreadyLoggedIn');
Route::get('/registration', [CustomAuthenticationController::class,'registration'])->middleware('alreadyLoggedIn');
Route::post('/register-user',[CustomAuthenticationController::class,'registerUser'])->name('register-user');
Route::post('/login-user', [CustomAuthenticationController::class, 'loginUser'])->name('login-user');
Route::get('/dashboard',[CustomAuthenticationController::class,'dashboard'])->middleware('isLoggedIn');
Route::get('/logout', [CustomAuthenticationController::class,'logout']);
Route::match(['get', 'post'], 'forgot-password', [CustomAuthenticationController::class, 'forgotPassword'])->name('forgot-password');
