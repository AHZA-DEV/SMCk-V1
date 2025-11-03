
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
    <div class="card-header">
        <h5 class="mb-0">Jenis Cuti</h5>
    </div>
    <div class="card-body">
        <button class="btn btn-primary mb-3">
            <i class="bi bi-plus-circle me-2"></i>Tambah Jenis Cuti
        </button>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Jenis Cuti</th>
                        <th>Maksimal Hari</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Cuti Tahunan</td>
                        <td>12 hari</td>
                        <td>Cuti tahunan yang diberikan setiap tahun</td>
                        <td>
                            <button class="btn btn-sm btn-warning" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Cuti Sakit</td>
                        <td>- </td>
                        <td>Cuti karena sakit dengan surat dokter</td>
                        <td>
                            <button class="btn btn-sm btn-warning" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
