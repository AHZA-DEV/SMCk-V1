@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2>Ajukan Cuti Baru</h2>
            <p class="text-muted">Ajukan permohonan cuti Anda</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Form Pengajuan Cuti</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('karyawan.ajukan-cuti.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Jenis Cuti <span class="text-danger">*</span></label>
                            <select class="form-select @error('jenis_cuti_id') is-invalid @enderror" name="jenis_cuti_id" required>
                                <option value="">Pilih Jenis Cuti</option>
                                @foreach($jenisCutis as $jenis)
                                    <option value="{{ $jenis->id }}" {{ old('jenis_cuti_id') == $jenis->id ? 'selected' : '' }}>
                                        {{ $jenis->nama_cuti }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jenis_cuti_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror" 
                                       name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" 
                                       min="{{ date('Y-m-d') }}" required>
                                @error('tanggal_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Selesai <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror" 
                                       name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" required>
                                @error('tanggal_selesai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alasan Cuti <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('alasan') is-invalid @enderror" name="alasan" 
                                      rows="4" placeholder="Jelaskan alasan pengajuan cuti Anda..." required>{{ old('alasan') }}</textarea>
                            @error('alasan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lampiran (Opsional)</label>
                            <input type="file" class="form-control @error('lampiran') is-invalid @enderror" name="lampiran">
                            <small class="text-muted">Format: PDF, JPG, PNG. Max: 2MB</small>
                            @error('lampiran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-send"></i> Ajukan Cuti
                            </button>
                            <button type="reset" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> Reset
                            </button>
                            <a href="{{ route('karyawan.dashboard') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
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
                        <h3 class="text-primary">{{ $karyawan->sisa_cuti }} Hari</h3>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <h6>Cuti Terpakai</h6>
                        <p class="mb-0">{{ 12 - $karyawan->sisa_cuti }} Hari</p>
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
                    <p>- Pengajuan cuti minimal 3 hari sebelum tanggal mulai</p>
                    <p>- Cuti sakit wajib melampirkan surat keterangan dokter</p>
                    <p>- Cuti akan disetujui oleh HRD</p>
                    <p>- Pastikan tanggal yang dipilih sudah benar</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
