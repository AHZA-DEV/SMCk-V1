<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Admin\KaryawanController;
use App\Http\Controllers\Api\Admin\DepartemenController;
use App\Http\Controllers\Api\Admin\CutiController;
use App\Http\Controllers\Api\Admin\JenisCutiController;
use App\Http\Controllers\Api\Admin\PengaturanSistemController;
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
});



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
