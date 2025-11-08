
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="welcome-section mb-4">
        <h2>Selamat Datang, {{ Auth::guard('karyawan')->user()->nama_depan }} {{ Auth::guard('karyawan')->user()->nama_belakang }}!</h2>
        <p class="text-muted">Dashboard Karyawan - Sistem Manajemen Cuti</p>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Sisa Cuti Tahunan</h6>
                    <h2 class="card-title">{{ $sisaCuti }}</h2>
                    <p class="mb-0"><i class="bi bi-calendar-event"></i> Hari</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Cuti Terpakai</h6>
                    <h2 class="card-title">{{ $cutiTerpakai }}</h2>
                    <p class="mb-0"><i class="bi bi-calendar-check"></i> Hari</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Pengajuan Pending</h6>
                    <h2 class="card-title">{{ $pengajuanPending }}</h2>
                    <p class="mb-0"><i class="bi bi-hourglass-split"></i> Menunggu</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Cuti Disetujui</h6>
                    <h2 class="card-title">{{ $cutiDisetujui }}</h2>
                    <p class="mb-0"><i class="bi bi-check-circle"></i> Total</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-12 d-none d-md-block">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Riwayat Pengajuan Cuti Terbaru</h5>
                    <a href="{{ route('karyawan.ajukan-cuti.index') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Ajukan Cuti Baru
                    </a>
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
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($riwayatCuti as $cuti)
                                <tr>
                                    <td>{{ $cuti->jenisCuti->nama ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($cuti->tanggal_selesai)->format('d/m/Y') }}</td>
                                    <td>{{ $cuti->jumlah_hari }} hari</td>
                                    <td>
                                        @if($cuti->status == 'menunggu')
                                            <span class="badge bg-warning">Menunggu</span>
                                        @elseif($cuti->status == 'disetujui')
                                            <span class="badge bg-success">Disetujui</span>
                                        @else
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('karyawan.riwayat-cuti.show', $cuti->id) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada riwayat pengajuan cuti</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
