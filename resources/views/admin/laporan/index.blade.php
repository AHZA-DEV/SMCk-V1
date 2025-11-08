
@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Laporan Cuti</h2>
    <button class="btn btn-success">
        <i class="bi bi-file-earmark-excel me-2"></i>Export Excel
    </button>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body text-center">
                <h6 class="text-muted">Total Pengajuan</h6>
                <h3 class="mb-0">{{ $statistik['total_cuti'] }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body text-center">
                <h6 class="text-muted">Disetujui</h6>
                <h3 class="mb-0 text-success">{{ $statistik['disetujui'] }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body text-center">
                <h6 class="text-muted">Ditolak</h6>
                <h3 class="mb-0 text-danger">{{ $statistik['ditolak'] }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body text-center">
                <h6 class="text-muted">Pending</h6>
                <h3 class="mb-0 text-warning">{{ $statistik['pending'] }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <form method="GET" action="{{ route('admin.laporan.index') }}">
            <div class="row">
                <div class="col-md-3">
                    <select name="periode" class="form-select" onchange="this.form.submit()">
                        <option value="bulan_ini" {{ request('periode') == 'bulan_ini' ? 'selected' : '' }}>Bulan Ini</option>
                        <option value="3_bulan" {{ request('periode') == '3_bulan' ? 'selected' : '' }}>3 Bulan Terakhir</option>
                        <option value="6_bulan" {{ request('periode') == '6_bulan' ? 'selected' : '' }}>6 Bulan Terakhir</option>
                        <option value="1_tahun" {{ request('periode') == '1_tahun' ? 'selected' : '' }}>1 Tahun Terakhir</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="departemen_id" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Departemen</option>
                        @foreach($departemens as $departemen)
                            <option value="{{ $departemen->id }}" {{ request('departemen_id') == $departemen->id ? 'selected' : '' }}>
                                {{ $departemen->nama_departemen }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="jenis_cuti_id" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Jenis Cuti</option>
                        @foreach($jenisCutis as $jenisCuti)
                            <option value="{{ $jenisCuti->id }}" {{ request('jenis_cuti_id') == $jenisCuti->id ? 'selected' : '' }}>
                                {{ $jenisCuti->nama_cuti }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>
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
        
        @if($cutis->hasPages())
        <div class="d-flex justify-content-center mt-3">
            {{ $cutis->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
