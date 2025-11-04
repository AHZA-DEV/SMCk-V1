<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\JenisCutiController;
use App\Http\Controllers\PengaturanSistemController;
use App\Http\Controllers\HrdController;
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
Route::middleware(['auth:web', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');

    // Kelola Karyawan (Full CRUD with resource)
    Route::resource('karyawan', KaryawanController::class);

    // Kelola Departemen (Full CRUD with resource)
    Route::resource('departemen', DepartemenController::class);

    // Kelola Cuti
    Route::get('cuti', [CutiController::class, 'index'])->name('cuti.index');
    Route::get('cuti/{id}', [CutiController::class, 'show'])->name('cuti.show');
    Route::put('cuti/{id}/status', [CutiController::class, 'updateStatus'])->name('cuti.updateStatus');
    Route::delete('cuti/{id}', [CutiController::class, 'destroy'])->name('cuti.destroy');

    // Kelola Jenis Cuti (Full CRUD with resource)
    Route::resource('jenis-cuti', JenisCutiController::class);

    // Kelola HRD - only index and show
    Route::get('hrd', [HrdController::class, 'index'])->name('hrd.index');
    Route::get('hrd/{id}', [HrdController::class, 'show'])->name('hrd.show');

    // Laporan
    Route::get('laporan', [App\Http\Controllers\LaporanController::class, 'index'])->name('laporan.index');

    // Pengaturan Sistem
    Route::get('pengaturan', [PengaturanSistemController::class, 'index'])->name('pengaturan.index');
    Route::put('pengaturan', [PengaturanSistemController::class, 'update'])->name('pengaturan.update');
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