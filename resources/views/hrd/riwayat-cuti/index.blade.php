
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2>Riwayat Cuti</h2>
            <p class="text-muted">Riwayat pengajuan cuti semua karyawan</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Riwayat Pengajuan Cuti</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Karyawan</th>
                            <th>Jenis Cuti</th>
                            <th>Periode</th>
                            <th>Durasi</th>
                            <th>Status</th>
                            <th>Disetujui Oleh</th>
                            <th>Tanggal Persetujuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Budi Santoso</td>
                            <td>Cuti Tahunan</td>
                            <td>15/10/2025 - 17/10/2025</td>
                            <td>3 hari</td>
                            <td><span class="badge bg-success">Disetujui</span></td>
                            <td>Ani Wulandari</td>
                            <td>14/10/2025</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Citra Dewi</td>
                            <td>Cuti Sakit</td>
                            <td>20/09/2025 - 21/09/2025</td>
                            <td>2 hari</td>
                            <td><span class="badge bg-success">Disetujui</span></td>
                            <td>Ani Wulandari</td>
                            <td>19/09/2025</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
