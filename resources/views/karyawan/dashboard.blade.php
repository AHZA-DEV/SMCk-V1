@extends('layouts.app')

@section('content')
<div class="welcome-section">
    <h2>Selamat Datang, {{ Auth::guard('karyawan')->user()->nama_lengkap }}!</h2>
    <p class="text-muted">Dashboard Karyawan - Sistem Manajemen Cuti</p>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card stat-card stat-card-blue">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Sisa Cuti Tahunan</h6>
                <h2 class="card-title">{{ Auth::guard('karyawan')->user()->sisa_cuti }}</h2>
                <p class="mb-0"><i class="bi bi-calendar-event"></i> Hari</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card stat-card stat-card-purple">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Cuti Terpakai</h6>
                <h2 class="card-title">{{ 12 - Auth::guard('karyawan')->user()->sisa_cuti }}</h2>
                <p class="mb-0"><i class="bi bi-calendar-check"></i> Hari</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card stat-card stat-card-indigo">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Pengajuan Pending</h6>
                <h2 class="card-title">2</h2>
                <p class="mb-0"><i class="bi bi-hourglass-split"></i> Menunggu</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card stat-card stat-card-orange">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Cuti Disetujui</h6>
                <h2 class="card-title">8</h2>
                <p class="mb-0"><i class="bi bi-check-circle"></i> Total</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Riwayat Pengajuan Cuti</h5>
                <button class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Ajukan Cuti Baru
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Jenis Cuti</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Durasi</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Cuti Tahunan</td>
                                <td>2025-10-15</td>
                                <td>2025-10-17</td>
                                <td>3 hari</td>
                                <td><span class="badge bg-success">Disetujui</span></td>
                                <td>Liburan keluarga</td>
                            </tr>
                            <tr>
                                <td>Cuti Sakit</td>
                                <td>2025-09-20</td>
                                <td>2025-09-21</td>
                                <td>2 hari</td>
                                <td><span class="badge bg-success">Disetujui</span></td>
                                <td>Sakit flu</td>
                            </tr>
                            <tr>
                                <td>Cuti Tahunan</td>
                                <td>2025-11-10</td>
                                <td>2025-11-14</td>
                                <td>5 hari</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                                <td>Mudik lebaran</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
