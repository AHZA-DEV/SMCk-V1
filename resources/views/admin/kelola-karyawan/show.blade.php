
@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h2>Detail Karyawan</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.karyawan.index') }}">Kelola Karyawan</a></li>
            <li class="breadcrumb-item active">Detail Karyawan</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <div class="mb-3">
                    <i class="bi bi-person-circle" style="font-size: 120px; color: #6c757d;"></i>
                </div>
                <h4>{{ $karyawan->nama_lengkap }}</h4>
                <p class="text-muted">{{ $karyawan->jabatan }}</p>
                <span class="badge bg-{{ $karyawan->peran == 'hrd' ? 'primary' : 'success' }}">
                    {{ strtoupper($karyawan->peran) }}
                </span>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Informasi Pribadi</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
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
                        <th>No Telepon</th>
                        <td>{{ $karyawan->no_telepon ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $karyawan->alamat ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h5 class="mb-0">Informasi Pekerjaan</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">Departemen</th>
                        <td>{{ $karyawan->departemen->nama_departemen ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Jabatan</th>
                        <td>{{ $karyawan->jabatan }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Mulai Kerja</th>
                        <td>{{ $karyawan->tanggal_mulai_kerja ? $karyawan->tanggal_mulai_kerja->format('d F Y') : '-' }}</td>
                    </tr>
                    <tr>
                        <th>Peran</th>
                        <td>
                            <span class="badge bg-{{ $karyawan->peran == 'hrd' ? 'primary' : 'success' }}">
                                {{ strtoupper($karyawan->peran) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Sisa Cuti</th>
                        <td>{{ $karyawan->sisa_cuti }} hari</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-3">
            <a href="{{ route('admin.karyawan.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('admin.karyawan.edit', $karyawan->id) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>
@endsection
