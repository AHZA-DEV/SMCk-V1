
@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Kelola Pengajuan Cuti</h2>
</div>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Cari pengajuan...">
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option value="">Semua Status</option>
                    <option>Pending</option>
                    <option>Disetujui</option>
                    <option>Ditolak</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option value="">Semua Jenis Cuti</option>
                    <option>Cuti Tahunan</option>
                    <option>Cuti Sakit</option>
                    <option>Cuti Penting</option>
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
                        <th>NIP</th>
                        <th>Nama Karyawan</th>
                        <th>Jenis Cuti</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Durasi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>KRY001</td>
                        <td>Budi Santoso</td>
                        <td>Cuti Tahunan</td>
                        <td>15/11/2025</td>
                        <td>17/11/2025</td>
                        <td>3 hari</td>
                        <td><span class="badge bg-warning">Pending</span></td>
                        <td>
                            <button class="btn btn-sm btn-info" title="Detail">
                                <i class="bi bi-eye"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
