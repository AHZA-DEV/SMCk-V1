@extends('layouts.app')

@section('content')
<div class="welcome-section">
    <h2>Selamat Datang, {{ Auth::guard('karyawan')->user()->nama_lengkap }}!</h2>
    <p class="text-muted">Dashboard HRD - Sistem Manajemen Cuti</p>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card stat-card stat-card-blue">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Pengajuan Pending</h6>
                <h2 class="card-title">28</h2>
                <p class="mb-0"><i class="bi bi-hourglass-split"></i> Menunggu Approval</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card stat-card stat-card-purple">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Disetujui Hari Ini</h6>
                <h2 class="card-title">12</h2>
                <p class="mb-0"><i class="bi bi-check-circle"></i> Approved</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card stat-card stat-card-indigo">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Ditolak Bulan Ini</h6>
                <h2 class="card-title">5</h2>
                <p class="mb-0"><i class="bi bi-x-circle"></i> Rejected</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card stat-card stat-card-orange">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Total Karyawan</h6>
                <h2 class="card-title">150</h2>
                <p class="mb-0"><i class="bi bi-people"></i> Active</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Daftar Pengajuan Cuti</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Karyawan</th>
                                <th>Jenis Cuti</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Durasi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Budi Santoso</td>
                                <td>Cuti Tahunan</td>
                                <td>2025-11-05</td>
                                <td>2025-11-07</td>
                                <td>3 hari</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                                <td>
                                    <button class="btn btn-sm btn-success">Setujui</button>
                                    <button class="btn btn-sm btn-danger">Tolak</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Citra Dewi</td>
                                <td>Cuti Sakit</td>
                                <td>2025-11-04</td>
                                <td>2025-11-06</td>
                                <td>3 hari</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                                <td>
                                    <button class="btn btn-sm btn-success">Setujui</button>
                                    <button class="btn btn-sm btn-danger">Tolak</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
