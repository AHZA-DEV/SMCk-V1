
@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h2>Detail Jenis Cuti</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.jenis-cuti.index') }}">Jenis Cuti</a></li>
            <li class="breadcrumb-item active">Detail Jenis Cuti</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Informasi Jenis Cuti</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">Kode Cuti</th>
                        <td>{{ $jenisCuti->kode_cuti }}</td>
                    </tr>
                    <tr>
                        <th>Nama Jenis Cuti</th>
                        <td>{{ $jenisCuti->nama_cuti }}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>{{ $jenisCuti->deskripsi ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Maksimal Hari</th>
                        <td>{{ $jenisCuti->maksimal_hari ? $jenisCuti->maksimal_hari . ' hari' : 'Tidak ada batas' }}</td>
                    </tr>
                    <tr>
                        <th>Status Pembayaran</th>
                        <td>
                            <span class="badge bg-{{ $jenisCuti->is_dibayar ? 'success' : 'secondary' }}">
                                {{ $jenisCuti->is_dibayar ? 'Dibayar' : 'Tidak Dibayar' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Total Penggunaan</th>
                        <td>{{ $jenisCuti->cutis_count }} kali</td>
                    </tr>
                </table>

                <div class="d-flex justify-content-end gap-2 mt-3">
                    <a href="{{ route('admin.jenis-cuti.index') }}" class="btn btn-secondary">Kembali</a>
                    <a href="{{ route('admin.jenis-cuti.edit', $jenisCuti->id) }}" class="btn btn-warning">Edit</a>
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
                    <i class="bi bi-calendar-event" style="font-size: 60px; color: #4e73df;"></i>
                </div>
                <h2>{{ $jenisCuti->cutis_count }}</h2>
                <p class="text-muted">Total Penggunaan</p>
            </div>
        </div>
    </div>
</div>
@endsection
