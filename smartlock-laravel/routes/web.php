<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SmartLockController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/smartlock', [SmartLockController::class, 'controlPanel'])->name('smartlock.control');
    Route::post('/smartlock/pin', [SmartLockController::class, 'setPin'])->name('smartlock.setPin');
    Route::post('/smartlock/open', [SmartLockController::class, 'openDoor'])->name('smartlock.open');
    Route::post('/smartlock/close', [SmartLockController::class, 'closeDoor'])->name('smartlock.close');
});
