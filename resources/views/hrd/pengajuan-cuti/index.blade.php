
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2>Pengajuan Cuti</h2>
            <p class="text-muted">Semua pengajuan cuti karyawan</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Pengajuan Cuti</h5>
                <div>
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
                        <tr>
                            <td>1</td>
                            <td>01/11/2025</td>
                            <td>Budi Santoso</td>
                            <td>Cuti Tahunan</td>
                            <td>05/11/2025 - 07/11/2025</td>
                            <td>3 hari</td>
                            <td><span class="badge bg-warning">Pending</span></td>
                            <td>
                                <button class="btn btn-sm btn-info" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>30/10/2025</td>
                            <td>Citra Dewi</td>
                            <td>Cuti Sakit</td>
                            <td>04/11/2025 - 06/11/2025</td>
                            <td>3 hari</td>
                            <td><span class="badge bg-success">Disetujui</span></td>
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
</div>
@endsection
