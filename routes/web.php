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
Route::middleware(['auth:karyawan', 'role:hrd'])->prefix('hrd')->name('hrd.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Hrd\DashboardController::class, 'index'])->name('dashboard');

    // Approval Cuti
    Route::prefix('approval-cuti')->name('approval-cuti.')->group(function () {
        Route::get('/', [App\Http\Controllers\Hrd\ApprovalCutiController::class, 'index'])->name('index');
        Route::get('/{id}', [App\Http\Controllers\Hrd\ApprovalCutiController::class, 'show'])->name('show');
        Route::post('/{id}/approve', [App\Http\Controllers\Hrd\ApprovalCutiController::class, 'approve'])->name('approve');
        Route::post('/{id}/reject', [App\Http\Controllers\Hrd\ApprovalCutiController::class, 'reject'])->name('reject');
    });

    // Data Karyawan
    Route::prefix('data-karyawan')->name('data-karyawan.')->group(function () {
        Route::get('/', [App\Http\Controllers\Hrd\DataKaryawanController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\Hrd\DataKaryawanController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\Hrd\DataKaryawanController::class, 'store'])->name('store');
        Route::get('/{id}', [App\Http\Controllers\Hrd\DataKaryawanController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [App\Http\Controllers\Hrd\DataKaryawanController::class, 'edit'])->name('edit');
        Route::put('/{id}', [App\Http\Controllers\Hrd\DataKaryawanController::class, 'update'])->name('update');
        Route::delete('/{id}', [App\Http\Controllers\Hrd\DataKaryawanController::class, 'destroy'])->name('destroy');
    });

    // Pengajuan Cuti
    Route::prefix('pengajuan-cuti')->name('pengajuan-cuti.')->group(function () {
        Route::get('/', [App\Http\Controllers\Hrd\PengajuanCutiController::class, 'index'])->name('index');
        Route::get('/{id}', [App\Http\Controllers\Hrd\PengajuanCutiController::class, 'show'])->name('show');
    });

    // Riwayat Cuti
    Route::prefix('riwayat-cuti')->name('riwayat-cuti.')->group(function () {
        Route::get('/', [App\Http\Controllers\Hrd\RiwayatCutiController::class, 'index'])->name('index');
        Route::get('/{id}', [App\Http\Controllers\Hrd\RiwayatCutiController::class, 'show'])->name('show');
    });

    // Laporan
    Route::get('/laporan', [App\Http\Controllers\Hrd\LaporanController::class, 'index'])->name('laporan.index');

    // Profil
    Route::prefix('profil')->name('profil.')->group(function () {
        Route::get('/', [App\Http\Controllers\Hrd\ProfilController::class, 'index'])->name('index');
        Route::put('/', [App\Http\Controllers\Hrd\ProfilController::class, 'update'])->name('update');
        Route::put('/password', [App\Http\Controllers\Hrd\ProfilController::class, 'updatePassword'])->name('update-password');
    });
});

// Karyawan routes - menggunakan folder karyawan
Route::middleware(['auth:karyawan', 'role:karyawan'])->prefix('karyawan')->name('karyawan.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Karyawan\DashboardController::class, 'index'])->name('dashboard');
    
    // Ajukan Cuti
    Route::prefix('ajukan-cuti')->name('ajukan-cuti.')->group(function () {
        Route::get('/', [App\Http\Controllers\Karyawan\AjukanCutiController::class, 'index'])->name('index');
        Route::post('/', [App\Http\Controllers\Karyawan\AjukanCutiController::class, 'store'])->name('store');
    });
    
    // Riwayat Cuti
    Route::prefix('riwayat-cuti')->name('riwayat-cuti.')->group(function () {
        Route::get('/', [App\Http\Controllers\Karyawan\RiwayatCutiController::class, 'index'])->name('index');
        Route::get('/{id}', [App\Http\Controllers\Karyawan\RiwayatCutiController::class, 'show'])->name('show');
    });
    
    // Sisa Cuti
    Route::get('/sisa-cuti', [App\Http\Controllers\Karyawan\SisaCutiController::class, 'index'])->name('sisa-cuti.index');
    
    // Notifikasi
    Route::get('/notifikasi', [App\Http\Controllers\Karyawan\NotifikasiController::class, 'index'])->name('notifikasi.index');
    
    // Profil
    Route::prefix('profil')->name('profil.')->group(function () {
        Route::get('/', [App\Http\Controllers\Karyawan\ProfilController::class, 'index'])->name('index');
        Route::put('/', [App\Http\Controllers\Karyawan\ProfilController::class, 'update'])->name('update');
        Route::put('/password', [App\Http\Controllers\Karyawan\ProfilController::class, 'updatePassword'])->name('update-password');
    });
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