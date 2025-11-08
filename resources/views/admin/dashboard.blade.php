
@extends('layouts.app')

@section('content')
<div class="welcome-section">
    <h2>Selamat Datang, {{ Auth::guard('web')->user()->name ?? 'Administrator' }}!</h2>
    <p class="text-muted">Dashboard Administrator - Sistem Manajemen Cuti</p>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card ">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Total Karyawan</h6>
                <h2 class="card-title">{{ $totalKaryawan }}</h2>
                <p class="mb-0"><i class="bi bi-people"></i> Active Users</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Pengajuan Cuti</h6>
                <h2 class="card-title">{{ $cutiPending }}</h2>
                <p class="mb-0"><i class="bi bi-calendar-check"></i> Pending</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Cuti Disetujui</h6>
                <h2 class="card-title">{{ $cutiDisetujui }}</h2>
                <p class="mb-0"><i class="bi bi-check-circle"></i> Tahun Ini</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Departemen</h6>
                <h2 class="card-title">{{ $totalDepartemen }}</h2>
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
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Bulan</th>
                                <th>Disetujui</th>
                                <th>Ditolak</th>
                                <th>Pending</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Chart/Grafik akan ditambahkan nanti</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        </tbody>
                    </table>
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
                @forelse($cutiTerbaru as $cuti)
                <div class="order-item">
                    <div class="d-flex justify-content-between">
                        <span>{{ $cuti->karyawan->nama ?? 'N/A' }}</span>
                        @if($cuti->status == 'pending')
                            <span class="badge bg-warning">Pending</span>
                        @elseif($cuti->status == 'disetujui')
                            <span class="badge bg-success">Disetujui</span>
                        @elseif($cuti->status == 'ditolak')
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </div>
                    <small class="text-muted">
                        {{ $cuti->jenisCuti->nama_jenis ?? 'N/A' }} - 
                        {{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->diffInDays(\Carbon\Carbon::parse($cuti->tanggal_selesai)) + 1 }} hari
                    </small>
                    <small class="text-muted d-block">{{ $cuti->created_at->diffForHumans() }}</small>
                </div>
                @empty
                <p class="text-muted text-center">Belum ada pengajuan cuti</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
