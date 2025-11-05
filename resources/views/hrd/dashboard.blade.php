
@extends('layouts.app')

@section('content')
<div class="welcome-section">
    <h2>Selamat Datang, {{ Auth::guard('karyawan')->user()->nama }}!</h2>
    <p class="text-muted">Dashboard HRD - Sistem Manajemen Cuti</p>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card stat-card stat-card-blue">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Pengajuan Pending</h6>
                <h2 class="card-title">{{ $stats['pending'] }}</h2>
                <p class="mb-0"><i class="bi bi-hourglass-split"></i> Menunggu Approval</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card stat-card stat-card-purple">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Disetujui Hari Ini</h6>
                <h2 class="card-title">{{ $stats['disetujui_hari_ini'] }}</h2>
                <p class="mb-0"><i class="bi bi-check-circle"></i> Approved</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card stat-card stat-card-indigo">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Ditolak Bulan Ini</h6>
                <h2 class="card-title">{{ $stats['ditolak_bulan_ini'] }}</h2>
                <p class="mb-0"><i class="bi bi-x-circle"></i> Rejected</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card stat-card stat-card-orange">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Total Karyawan</h6>
                <h2 class="card-title">{{ $stats['total_karyawan'] }}</h2>
                <p class="mb-0"><i class="bi bi-people"></i> Active</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Daftar Pengajuan Cuti Pending</h5>
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
                            @forelse($pengajuanCuti as $cuti)
                            <tr>
                                <td>{{ $cuti->karyawan->nama }}</td>
                                <td>{{ $cuti->jenisCuti->nama_cuti }}</td>
                                <td>{{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($cuti->tanggal_selesai)->format('d/m/Y') }}</td>
                                <td>{{ $cuti->jumlah_hari }} hari</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                                <td>
                                    <a href="{{ route('hrd.approval-cuti.show', $cuti->id) }}" class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada pengajuan cuti pending</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
