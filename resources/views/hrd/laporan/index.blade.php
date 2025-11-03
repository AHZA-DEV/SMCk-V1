
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2>Laporan Cuti</h2>
            <p class="text-muted">Laporan dan statistik pengajuan cuti</p>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card stat-card stat-card-blue">
                <div class="card-body">
                    <h6>Total Pengajuan Bulan Ini</h6>
                    <h2>45</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card stat-card-purple">
                <div class="card-body">
                    <h6>Disetujui</h6>
                    <h2>32</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card stat-card-indigo">
                <div class="card-body">
                    <h6>Ditolak</h6>
                    <h2>5</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card stat-card-orange">
                <div class="card-body">
                    <h6>Pending</h6>
                    <h2>8</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Filter Laporan</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <label class="form-label">Periode</label>
                    <select class="form-select">
                        <option>Bulan Ini</option>
                        <option>3 Bulan Terakhir</option>
                        <option>6 Bulan Terakhir</option>
                        <option>1 Tahun Terakhir</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Departemen</label>
                    <select class="form-select">
                        <option>Semua Departemen</option>
                        <option>IT</option>
                        <option>HRD</option>
                        <option>Finance</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Jenis Cuti</label>
                    <select class="form-select">
                        <option>Semua Jenis</option>
                        <option>Cuti Tahunan</option>
                        <option>Cuti Sakit</option>
                        <option>Cuti Darurat</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">&nbsp;</label>
                    <button class="btn btn-primary w-100">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
