
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2>Detail Pengajuan Cuti</h2>
                    <p class="text-muted">Informasi lengkap pengajuan cuti Anda</p>
                </div>
                <a href="{{ route('karyawan.riwayat-cuti.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Cuti</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150">Jenis Cuti</th>
                                    <td>: {{ $cuti->jenisCuti->nama_cuti ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Mulai</th>
                                    <td>: {{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->format('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Selesai</th>
                                    <td>: {{ \Carbon\Carbon::parse($cuti->tanggal_selesai)->format('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Durasi</th>
                                    <td>: {{ $cuti->jumlah_hari }} hari</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150">Status</th>
                                    <td>:
                                        @if($cuti->status == 'menunggu')
                                            <span class="badge bg-warning">Menunggu</span>
                                        @elseif($cuti->status == 'disetujui')
                                            <span class="badge bg-success">Disetujui</span>
                                        @else
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tanggal Pengajuan</th>
                                    <td>: {{ $cuti->created_at->format('d F Y H:i') }}</td>
                                </tr>
                                @if($cuti->status != 'menunggu')
                                <tr>
                                    <th>Tanggal Diproses</th>
                                    <td>: {{ $cuti->disetujui_pada ? $cuti->disetujui_pada->format('d F Y H:i') : '-' }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <h6>Alasan Cuti</h6>
                        <p class="text-muted">{{ $cuti->alasan }}</p>
                    </div>

                    @if($cuti->lampiran)
                    <div class="mb-3">
                        <h6>Lampiran</h6>
                        <a href="{{ asset('storage/' . $cuti->lampiran) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-download"></i> Lihat Lampiran
                        </a>
                    </div>
                    @endif

                    @if($cuti->alasan_penolakan)
                    <hr>
                    <div class="mb-3">
                        <h6>Alasan Penolakan dari HRD</h6>
                        <div class="alert alert-danger">
                            {{ $cuti->alasan_penolakan }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Status Pengajuan</h5>
                </div>
                <div class="card-body text-center">
                    @if($cuti->status == 'menunggu')
                        <i class="bi bi-hourglass-split text-warning" style="font-size: 64px;"></i>
                        <h5 class="mt-3">Menunggu Persetujuan</h5>
                        <p class="text-muted">Pengajuan Anda sedang dalam proses review oleh HRD</p>
                    @elseif($cuti->status == 'disetujui')
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 64px;"></i>
                        <h5 class="mt-3">Disetujui</h5>
                        <p class="text-muted">Pengajuan cuti Anda telah disetujui</p>
                    @else
                        <i class="bi bi-x-circle-fill text-danger" style="font-size: 64px;"></i>
                        <h5 class="mt-3">Ditolak</h5>
                        <p class="text-muted">Pengajuan cuti Anda ditolak</p>
                    @endif
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Tambahan</h5>
                </div>
                <div class="card-body">
                    <p class="mb-2"><i class="bi bi-calendar-event text-primary me-2"></i> Jenis: <strong>{{ $cuti->jenisCuti->nama ?? '-' }}</strong></p>
                    <p class="mb-2"><i class="bi bi-clock-history text-primary me-2"></i> Durasi: <strong>{{ $cuti->jumlah_hari }} hari</strong></p>
                    <p class="mb-2"><i class="bi bi-calendar-check text-primary me-2"></i> Diajukan: <strong>{{ $cuti->created_at->diffForHumans() }}</strong></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
