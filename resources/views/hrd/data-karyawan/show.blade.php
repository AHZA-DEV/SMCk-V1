@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2>Detail Karyawan</h2>
                    <p class="text-muted">Informasi lengkap karyawan</p>
                </div>
                <a href="{{ route('hrd.data-karyawan.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="bi bi-person-circle" style="font-size: 100px; color: #6c757d;"></i>
                    <h4 class="mt-3">{{ $karyawan->nama_lengkap }}</h4>
                    <p class="text-muted">{{ $karyawan->jabatan }}</p>
                    <span class="badge {{ $karyawan->status == 'aktif' ? 'bg-success' : 'bg-danger' }}">
                        {{ ucfirst($karyawan->status) }}
                    </span>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">Sisa Cuti</h5>
                </div>
                <div class="card-body">
                    <h2 class="text-primary mb-0">
                        {{ $karyawan->sisaCutiTahunan->where('tahun', date('Y'))->first()?->sisa_cuti ?? 0 }} hari
                    </h2>
                    <small class="text-muted">Tahun {{ now()->year }}</small>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Pribadi</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th width="200">NIP</th>
                            <td>{{ $karyawan->nip }}</td>
                        </tr>
                        <tr>
                            <th>Nama Lengkap</th>
                            <td>{{ $karyawan->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $karyawan->email }}</td>
                        </tr>
                        <tr>
                            <th>No. Telepon</th>
                            <td>{{ $karyawan->no_telepon ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Departemen</th>
                            <td>{{ $karyawan->departemen->nama_departemen ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Jabatan</th>
                            <td>{{ $karyawan->jabatan }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Masuk</th>
                            <td>{{ \Carbon\Carbon::parse($karyawan->tanggal_mulai_kerja)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge {{ $karyawan->status == 'aktif' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($karyawan->status) }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">Riwayat Cuti</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Jenis Cuti</th>
                                    <th>Periode</th>
                                    <th>Durasi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($karyawan->cuti as $cuti)
                                <tr>
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
                                    <td colspan="4" class="text-center">Belum ada riwayat cuti</td>
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