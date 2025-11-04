@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h2>Detail Departemen</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.departemen.index') }}">Kelola Departemen</a></li>
            <li class="breadcrumb-item active">Detail Departemen</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Informasi Departemen</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">Kode Departemen</th>
                        <td>{{ $departemen->kode_departemen }}</td>
                    </tr>
                    <tr>
                        <th>Nama Departemen</th>
                        <td>{{ $departemen->nama_departemen }}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>{{ $departemen->deskripsi ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah Karyawan</th>
                        <td>{{ $departemen->karyawans->count() }} orang</td>
                    </tr>
                    <tr>
                        <th>Dibuat Pada</th>
                        <td>{{ $departemen->created_at->format('d F Y H:i') }}</td>
                    </tr>
                </table>

                <div class="d-flex justify-content-end gap-2 mt-3">
                    <a href="{{ route('admin.departemen.index') }}" class="btn btn-secondary">Kembali</a>
                    <a href="{{ route('admin.departemen.edit', $departemen->id) }}" class="btn btn-warning">Edit</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Statistik</h5>
            </div>
            <div class="card-body text-center">
                <div class="mb-3">
                    <i class="bi bi-people-fill" style="font-size: 60px; color: #4e73df;"></i>
                </div>
                <h2>{{ $departemen->karyawans->count() }}</h2>
                <p class="text-muted">Total Karyawan</p>
            </div>
        </div>
    </div>
</div>

@if($departemen->karyawans->count() > 0)
<div class="card mt-3">
    <div class="card-header">
        <h5 class="mb-0">Daftar Karyawan</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Email</th>
                        <th>Peran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($departemen->karyawans as $index => $karyawan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $karyawan->nip }}</td>
                        <td>{{ $karyawan->nama_lengkap }}</td>
                        <td>{{ $karyawan->jabatan }}</td>
                        <td>{{ $karyawan->email }}</td>
                        <td>
                            <span class="badge bg-{{ $karyawan->peran == 'hrd' ? 'primary' : 'success' }}">
                                {{ strtoupper($karyawan->peran) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@endsection
