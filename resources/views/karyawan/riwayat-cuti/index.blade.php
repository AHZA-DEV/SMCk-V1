
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2>Riwayat Cuti</h2>
            <p class="text-muted">Lihat riwayat pengajuan cuti Anda</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Riwayat Cuti</h5>
            <a href="{{ route('karyawan.ajukan-cuti.index') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Ajukan Cuti Baru
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Jenis Cuti</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Durasi</th>
                            <th>Status</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cutis as $index => $cuti)
                        <tr>
                            <td>{{ $cutis->firstItem() + $index }}</td>
                            <td>{{ $cuti->jenisCuti->nama_cuti ?? '-' }}</td>
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
                            <td>{{ $cuti->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('karyawan.riwayat-cuti.show', $cuti->id) }}" 
                                   class="btn btn-sm btn-info" title="Lihat Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Belum ada riwayat pengajuan cuti</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($cutis->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $cutis->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
