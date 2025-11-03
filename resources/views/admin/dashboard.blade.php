@extends('layouts.app')

@section('content')
<div class="welcome-section">
    <h2>Selamat Datang, {{ Auth::guard('web')->user()->name ?? 'Administrator' }}!</h2>
    <p class="text-muted">Dashboard Administrator - Sistem Manajemen Cuti</p>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card stat-card stat-card-blue">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Total Karyawan</h6>
                <h2 class="card-title">150</h2>
                <p class="mb-0"><i class="bi bi-people"></i> Active Users</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card stat-card stat-card-purple">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Pengajuan Cuti</h6>
                <h2 class="card-title">45</h2>
                <p class="mb-0"><i class="bi bi-calendar-check"></i> Pending</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card stat-card stat-card-indigo">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Cuti Disetujui</h6>
                <h2 class="card-title">320</h2>
                <p class="mb-0"><i class="bi bi-check-circle"></i> This Month</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card stat-card stat-card-orange">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Departemen</h6>
                <h2 class="card-title">12</h2>
                <p class="mb-0"><i class="bi bi-building"></i> Active</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Statistik Cuti Bulanan</h5>
            </div>
            <div class="card-body">
                <div class="sales-chart-placeholder" style="height: 300px;">
                    <div class="d-flex align-items-center justify-content-center h-100">
                        <p class="text-muted">Chart Area - Grafik Statistik Cuti</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Pengajuan Terbaru</h5>
            </div>
            <div class="card-body">
                <div class="order-item">
                    <div class="d-flex justify-content-between">
                        <span>Budi Santoso</span>
                        <span class="badge bg-warning">Pending</span>
                    </div>
                    <small class="text-muted">Cuti Tahunan - 3 hari</small>
                </div>
                <div class="order-item">
                    <div class="d-flex justify-content-between">
                        <span>Ani Wulandari</span>
                        <span class="badge bg-success">Disetujui</span>
                    </div>
                    <small class="text-muted">Cuti Sakit - 2 hari</small>
                </div>
                <div class="order-item">
                    <div class="d-flex justify-content-between">
                        <span>Citra Dewi</span>
                        <span class="badge bg-warning">Pending</span>
                    </div>
                    <small class="text-muted">Cuti Tahunan - 5 hari</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
