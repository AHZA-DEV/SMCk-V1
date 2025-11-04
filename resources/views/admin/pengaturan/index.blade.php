
@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h2>Pengaturan Sistem</h2>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Pengaturan Cuti</h5>
    </div>
    <div class="card-body">
        <form>
            <div class="mb-3">
                <label class="form-label">Jatah Cuti Tahunan (hari)</label>
                <input type="number" class="form-control" value="12">
            </div>
            <div class="mb-3">
                <label class="form-label">Maksimal Cuti Berturut-turut (hari)</label>
                <input type="number" class="form-control" value="14">
            </div>
            <div class="mb-3">
                <label class="form-label">Minimal Pengajuan Sebelum Cuti (hari)</label>
                <input type="number" class="form-control" value="3">
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="carryOver" checked>
                    <label class="form-check-label" for="carryOver">
                        Izinkan Carry Over Cuti ke Tahun Berikutnya
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
        </form>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Jenis Cuti</h5>
        <a href="{{ route('admin.jenis-cuti.index') }}" class="btn btn-sm btn-primary">
            Kelola Jenis Cuti <i class="bi bi-arrow-right ms-2"></i>
        </a>
    </div>
</div>
@endsection
