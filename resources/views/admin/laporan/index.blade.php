
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
                <h3 class="mb-0">450</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body text-center">
                <h6 class="text-muted">Disetujui</h6>
                <h3 class="mb-0 text-success">320</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body text-center">
                <h6 class="text-muted">Ditolak</h6>
                <h3 class="mb-0 text-danger">85</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body text-center">
                <h6 class="text-muted">Pending</h6>
                <h3 class="mb-0 text-warning">45</h3>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-3">
                <select class="form-select">
                    <option>Bulan Ini</option>
                    <option>Bulan Lalu</option>
                    <option>3 Bulan Terakhir</option>
                    <option>Tahun Ini</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option value="">Semua Departemen</option>
                    <option>IT</option>
                    <option>HRD</option>
                    <option>Finance</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Karyawan</th>
                        <th>Departemen</th>
                        <th>Jenis Cuti</th>
                        <th>Tanggal</th>
                        <th>Durasi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Budi Santoso</td>
                        <td>IT</td>
                        <td>Cuti Tahunan</td>
                        <td>15/11/2025 - 17/11/2025</td>
                        <td>3 hari</td>
                        <td><span class="badge bg-success">Disetujui</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
