
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2>Laporan Cuti</h2>
            <p class="text-muted">Laporan dan statistik pengajuan cuti</p>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card stat-card stat-card-blue">
                <div class="card-body">
                    <h6>Total Pengajuan Bulan Ini</h6>
                    <h2>{{ $statistik['total_pengajuan'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card stat-card-purple">
                <div class="card-body">
                    <h6>Disetujui</h6>
                    <h2>{{ $statistik['disetujui'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card stat-card-indigo">
                <div class="card-body">
                    <h6>Ditolak</h6>
                    <h2>{{ $statistik['ditolak'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card stat-card-orange">
                <div class="card-body">
                    <h6>Pending</h6>
                    <h2>{{ $statistik['pending'] }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Filter Laporan</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('hrd.laporan.index') }}">
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label">Periode</label>
                        <select name="periode" class="form-select">
                            <option value="bulan_ini" {{ request('periode') == 'bulan_ini' ? 'selected' : '' }}>Bulan Ini</option>
                            <option value="3_bulan" {{ request('periode') == '3_bulan' ? 'selected' : '' }}>3 Bulan Terakhir</option>
                            <option value="6_bulan" {{ request('periode') == '6_bulan' ? 'selected' : '' }}>6 Bulan Terakhir</option>
                            <option value="1_tahun" {{ request('periode') == '1_tahun' ? 'selected' : '' }}>1 Tahun Terakhir</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Departemen</label>
                        <select name="departemen_id" class="form-select">
                            <option value="">Semua Departemen</option>
                            @foreach($departemens as $departemen)
                                <option value="{{ $departemen->id }}" {{ request('departemen_id') == $departemen->id ? 'selected' : '' }}>
                                    {{ $departemen->nama_departemen }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Jenis Cuti</label>
                        <select name="jenis_cuti_id" class="form-select">
                            <option value="">Semua Jenis</option>
                            @foreach($jenisCutis as $jenisCuti)
                                <option value="{{ $jenisCuti->id }}" {{ request('jenis_cuti_id') == $jenisCuti->id ? 'selected' : '' }}>
                                    {{ $jenisCuti->nama_cuti }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-funnel"></i> Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Detail Laporan</h5>
                <button class="btn btn-success btn-sm">
                    <i class="bi bi-file-excel"></i> Export Excel
                </button>
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
                            <th>Departemen</th>
                            <th>Jenis Cuti</th>
                            <th>Periode</th>
                            <th>Durasi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cutis as $index => $cuti)
                        <tr>
                            <td>{{ $cutis->firstItem() + $index }}</td>
                            <td>{{ \Carbon\Carbon::parse($cuti->created_at)->format('d/m/Y') }}</td>
                            <td>{{ $cuti->karyawan->nama }}</td>
                            <td>{{ $cuti->karyawan->departemen->nama_departemen ?? '-' }}</td>
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
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data laporan</td>
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
