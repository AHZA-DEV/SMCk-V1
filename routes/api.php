<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Admin\KaryawanController;
use App\Http\Controllers\Api\Admin\DepartemenController;
use App\Http\Controllers\Api\Admin\CutiController;
use App\Http\Controllers\Api\Admin\JenisCutiController;
use App\Http\Controllers\Api\Admin\PengaturanSistemController;
use App\Http\Controllers\Api\Karyawan\NotifikasiController;
use App\Http\Controllers\Api\Karyawan\RiwayatCutiController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Admin routes
    Route::prefix('admin')->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index']);
        
        // Karyawan
        Route::apiResource('karyawan', KaryawanController::class);
        
        // Departemen
        Route::apiResource('departemen', DepartemenController::class);
        
        // Cuti
        Route::get('cuti', [CutiController::class, 'index']);
        Route::get('cuti/{id}', [CutiController::class, 'show']);
        Route::put('cuti/{id}/status', [CutiController::class, 'updateStatus']);
        Route::delete('cuti/{id}', [CutiController::class, 'destroy']);
        
        // Jenis Cuti
        Route::apiResource('jenis-cuti', JenisCutiController::class);
        
        // Pengaturan Sistem
        Route::get('pengaturan', [PengaturanSistemController::class, 'index']);
        Route::put('pengaturan', [PengaturanSistemController::class, 'update']);
        
        // HRD Management
        Route::apiResource('hrd', App\Http\Controllers\Api\Admin\HrdController::class);
        
        // Laporan
        Route::get('laporan', [App\Http\Controllers\Api\Admin\LaporanController::class, 'index']);
        Route::post('laporan/export', [App\Http\Controllers\Api\Admin\LaporanController::class, 'export']);
    });

    // HRD routes
    Route::prefix('hrd')->group(function () {
        // Dashboard
        Route::get('dashboard', [App\Http\Controllers\Api\Hrd\DashboardController::class, 'index']);
        
        // Approval Cuti
        Route::get('approval-cuti', [App\Http\Controllers\Api\Hrd\ApprovalCutiController::class, 'index']);
        Route::get('approval-cuti/{id}', [App\Http\Controllers\Api\Hrd\ApprovalCutiController::class, 'show']);
        Route::post('approval-cuti/{id}/approve', [App\Http\Controllers\Api\Hrd\ApprovalCutiController::class, 'approve']);
        Route::post('approval-cuti/{id}/reject', [App\Http\Controllers\Api\Hrd\ApprovalCutiController::class, 'reject']);
        
        // Data Karyawan
        Route::get('data-karyawan', [App\Http\Controllers\Api\Hrd\DataKaryawanController::class, 'index']);
        Route::get('data-karyawan/{id}', [App\Http\Controllers\Api\Hrd\DataKaryawanController::class, 'show']);
        
        // Riwayat Cuti
        Route::get('riwayat-cuti', [App\Http\Controllers\Api\Hrd\RiwayatCutiController::class, 'index']);
        Route::get('riwayat-cuti/{id}', [App\Http\Controllers\Api\Hrd\RiwayatCutiController::class, 'show']);
        
        // Laporan
        Route::get('laporan', [App\Http\Controllers\Api\Hrd\LaporanController::class, 'index']);
        Route::post('laporan/export', [App\Http\Controllers\Api\Hrd\LaporanController::class, 'export']);
        
        // Profil
        Route::get('profil', [App\Http\Controllers\Api\Hrd\ProfilController::class, 'index']);
        Route::put('profil', [App\Http\Controllers\Api\Hrd\ProfilController::class, 'update']);
        Route::put('profil/password', [App\Http\Controllers\Api\Hrd\ProfilController::class, 'updatePassword']);
    });

    // Karyawan routes
    Route::prefix('karyawan')->group(function () {
        // Notifikasi
        Route::get('notifikasi', [NotifikasiController::class, 'index']);
        Route::put('notifikasi/{id}/read', [NotifikasiController::class, 'markAsRead']);
        Route::put('notifikasi/read-all', [NotifikasiController::class, 'markAllAsRead']);
        Route::get('notifikasi/unread-count', [NotifikasiController::class, 'unreadCount']);

        // Riwayat Cuti
        Route::get('riwayat-cuti', [RiwayatCutiController::class, 'index']);
        Route::get('riwayat-cuti/{id}', [RiwayatCutiController::class, 'show']);
    });
});



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
