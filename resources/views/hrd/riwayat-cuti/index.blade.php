
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2>Riwayat Cuti</h2>
            <p class="text-muted">Riwayat pengajuan cuti semua karyawan</p>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Riwayat Pengajuan Cuti</h5>
                <div>
                    <form method="GET" action="{{ route('hrd.riwayat-cuti.index') }}" class="d-inline">
                        <input type="text" name="search" class="form-control form-control-sm d-inline" style="width: 250px;" placeholder="Cari nama karyawan..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Karyawan</th>
                            <th>Jenis Cuti</th>
                            <th>Periode</th>
                            <th>Durasi</th>
                            <th>Status</th>
                            <th>Disetujui Oleh</th>
                            <th>Tanggal Persetujuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cutis as $index => $cuti)
                        <tr>
                            <td>{{ $cutis->firstItem() + $index }}</td>
                            <td>{{ $cuti->karyawan->nama }}</td>
                            <td>{{ $cuti->jenisCuti->nama_cuti }}</td>
                            <td>{{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($cuti->tanggal_selesai)->format('d/m/Y') }}</td>
                            <td>{{ $cuti->jumlah_hari }} hari</td>
                            <td>
                                @if($cuti->status == 'disetujui')
                                    <span class="badge bg-success">Disetujui</span>
                                @else
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                            <td>{{ $cuti->disetujui_oleh ?? '-' }}</td>
                            <td>{{ $cuti->tanggal_approve ? \Carbon\Carbon::parse($cuti->tanggal_approve)->format('d/m/Y') : '-' }}</td>
                            <td>
                                <a href="{{ route('hrd.riwayat-cuti.show', $cuti->id) }}" class="btn btn-sm btn-info" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">Tidak ada riwayat cuti</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $cutis->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
