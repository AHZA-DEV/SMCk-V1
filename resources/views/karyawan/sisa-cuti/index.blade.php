
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2>Sisa Cuti</h2>
            <p class="text-muted">Informasi sisa cuti Anda</p>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card stat-card stat-card-blue">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Sisa Cuti Tahunan</h6>
                    <h2 class="card-title">{{ Auth::guard('karyawan')->user()->sisa_cuti }}</h2>
                    <p class="mb-0"><i class="bi bi-calendar-event"></i> Hari</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card stat-card stat-card-purple">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Cuti Terpakai</h6>
                    <h2 class="card-title">{{ 12 - Auth::guard('karyawan')->user()->sisa_cuti }}</h2>
                    <p class="mb-0"><i class="bi bi-calendar-check"></i> Hari</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card stat-card stat-card-indigo">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Total Jatah Cuti</h6>
                    <h2 class="card-title">12</h2>
                    <p class="mb-0"><i class="bi bi-calendar-range"></i> Hari/Tahun</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Detail Penggunaan Cuti</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Jenis Cuti</th>
                            <th>Jatah</th>
                            <th>Terpakai</th>
                            <th>Sisa</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Cuti Tahunan</td>
                            <td>12 hari</td>
                            <td>{{ 12 - Auth::guard('karyawan')->user()->sisa_cuti }} hari</td>
                            <td>{{ Auth::guard('karyawan')->user()->sisa_cuti }} hari</td>
                            <td>
                                @if(Auth::guard('karyawan')->user()->sisa_cuti > 6)
                                    <span class="badge bg-success">Banyak</span>
                                @elseif(Auth::guard('karyawan')->user()->sisa_cuti > 3)
                                    <span class="badge bg-warning">Sedang</span>
                                @else
                                    <span class="badge bg-danger">Sedikit</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-0">Informasi</h5>
        </div>
        <div class="card-body">
            <ul class="mb-0">
                <li>Jatah cuti tahunan adalah 12 hari per tahun</li>
                <li>Sisa cuti yang tidak digunakan tidak dapat dibawa ke tahun berikutnya</li>
                <li>Cuti sakit dan cuti darurat tidak mengurangi jatah cuti tahunan</li>
                <li>Pengajuan cuti harus dilakukan minimal 3 hari sebelum tanggal mulai cuti</li>
            </ul>
        </div>
    </div>
</div>
@endsection
