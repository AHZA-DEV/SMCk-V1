@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2>Ajukan Cuti Baru</h2>
            <p class="text-muted">Ajukan permohonan cuti Anda</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Form Pengajuan Cuti</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Jenis Cuti <span class="text-danger">*</span></label>
                            <select class="form-select" required>
                                <option value="">Pilih Jenis Cuti</option>
                                <option value="1">Cuti Tahunan</option>
                                <option value="2">Cuti Sakit</option>
                                <option value="3">Cuti Darurat</option>
                            </select>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Selesai <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alasan Cuti <span class="text-danger">*</span></label>
                            <textarea class="form-control" rows="4" placeholder="Jelaskan alasan pengajuan cuti Anda..." required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lampiran (Opsional)</label>
                            <input type="file" class="form-control">
                            <small class="text-muted">Format: PDF, JPG, PNG. Max: 2MB</small>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-send"></i> Ajukan Cuti
                            </button>
                            <button type="reset" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Cuti Anda</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6>Sisa Cuti Tahunan</h6>
                        <h3 class="text-primary">{{ Auth::guard('karyawan')->user()->sisa_cuti }} Hari</h3>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <h6>Cuti Terpakai</h6>
                        <p class="mb-0">{{ 12 - Auth::guard('karyawan')->user()->sisa_cuti }} Hari</p>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <h6>Total Jatah Cuti</h6>
                        <p class="mb-0">12 Hari/Tahun</p>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">Catatan</h5>
                </div>
                <div class="card-body">
                    <ul class="mb-0" style="padding-left: 20px;">
                        <li>Pengajuan cuti minimal 3 hari sebelum tanggal mulai</li>
                        <li>Cuti sakit wajib melampirkan surat keterangan dokter</li>
                        <li>Cuti akan disetujui oleh HRD</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
