<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Authenticated routes
Route::middleware('auth:web,karyawan')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/user', [AuthController::class, 'user']);
});

// Admin routes - menggunakan folder admin
Route::middleware(['auth:web', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// HRD routes - menggunakan folder hrd
Route::middleware(['auth:karyawan', 'role:hrd'])->prefix('hrd')->group(function () {
    Route::get('/dashboard', function () {
        return view('hrd.dashboard');
    })->name('hrd.dashboard');
});

// Karyawan routes - menggunakan folder karyawan
Route::middleware(['auth:karyawan', 'role:karyawan'])->prefix('karyawan')->group(function () {
    Route::get('/dashboard', function () {
        return view('karyawan.dashboard');
    })->name('karyawan.dashboard');
});

// Root redirect
Route::get('/', function () {
    if (Auth::guard('web')->check()) {
        return redirect()->route('admin.dashboard');
    } elseif (Auth::guard('karyawan')->check()) {
        $user = Auth::guard('karyawan')->user();
        return redirect($user->peran === 'hrd' ? route('hrd.dashboard') : route('karyawan.dashboard'));
    }
    return redirect()->route('login');
});
