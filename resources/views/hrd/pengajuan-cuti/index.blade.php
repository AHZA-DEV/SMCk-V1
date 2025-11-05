
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2>Pengajuan Cuti</h2>
            <p class="text-muted">Semua pengajuan cuti karyawan</p>
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
                <h5 class="mb-0">Daftar Pengajuan Cuti</h5>
                <div class="d-flex gap-2">
                    <form method="GET" action="{{ route('hrd.pengajuan-cuti.index') }}" class="d-flex gap-2">
                        <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </form>
                    <button class="btn btn-success btn-sm">
                        <i class="bi bi-file-excel"></i> Export Excel
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Nama Karyawan</th>
                            <th>Jenis Cuti</th>
                            <th>Periode</th>
                            <th>Durasi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cutis as $index => $cuti)
                        <tr>
                            <td>{{ $cutis->firstItem() + $index }}</td>
                            <td>{{ \Carbon\Carbon::parse($cuti->created_at)->format('d/m/Y') }}</td>
                            <td>{{ $cuti->karyawan->nama }}</td>
                            <td>{{ $cuti->jenisCuti->nama_cuti }}</td>
                            <td>{{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($cuti->tanggal_selesai)->format('d/m/Y') }}</td>
                            <td>{{ $cuti->jumlah_hari }} hari</td>
                            <td>
                                @if($cuti->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($cuti->status == 'disetujui')
                                    <span class="badge bg-success">Disetujui</span>
                                @else
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('hrd.pengajuan-cuti.show', $cuti->id) }}" class="btn btn-sm btn-info" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data pengajuan cuti</td>
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
