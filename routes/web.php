<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WeatherController;

// Redirect home to weather page (login page for unauthenticated users)
Route::get('/', function () {
    return view('auth.login');  // Redirect to login page if not logged in
})->name('home');

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protect Weather routes with authentication
Route::middleware(['auth'])->group(function () {
    // Protected weather route
    Route::get('/weather', [WeatherController::class, 'showWeather'])->name('weather');
    
    // Weather API route
    Route::get('/api/weather', [WeatherController::class, 'search']);
});

