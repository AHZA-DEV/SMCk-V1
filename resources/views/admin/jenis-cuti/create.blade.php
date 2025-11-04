@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h2>Tambah Jenis Cuti Baru</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.jenis-cuti.index') }}">Jenis Cuti</a></li>
            <li class="breadcrumb-item active">Tambah Jenis Cuti</li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.jenis-cuti.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="kode_cuti" class="form-label">Kode Cuti <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('kode_cuti') is-invalid @enderror" 
                       id="kode_cuti" name="kode_cuti" value="{{ old('kode_cuti') }}" 
                       placeholder="Contoh: CT, CS, CP" required>
                @error('kode_cuti')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nama_cuti" class="form-label">Nama Jenis Cuti <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('nama_cuti') is-invalid @enderror" 
                       id="nama_cuti" name="nama_cuti" value="{{ old('nama_cuti') }}" 
                       placeholder="Contoh: Cuti Tahunan" required>
                @error('nama_cuti')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                          id="deskripsi" name="deskripsi" rows="4" 
                          placeholder="Deskripsi jenis cuti">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="maksimal_hari" class="form-label">Maksimal Hari</label>
                        <input type="number" class="form-control @error('maksimal_hari') is-invalid @enderror" 
                               id="maksimal_hari" name="maksimal_hari" value="{{ old('maksimal_hari') }}" 
                               min="0" placeholder="Kosongkan jika tidak ada batas">
                        <small class="text-muted">Kosongkan jika tidak ada batas maksimal</small>
                        @error('maksimal_hari')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="is_dibayar" class="form-label">Status Pembayaran</label>
                        <select class="form-select @error('is_dibayar') is-invalid @enderror" 
                                id="is_dibayar" name="is_dibayar">
                            <option value="1" {{ old('is_dibayar') == '1' ? 'selected' : '' }}>Dibayar</option>
                            <option value="0" {{ old('is_dibayar') == '0' ? 'selected' : '' }}>Tidak Dibayar</option>
                        </select>
                        @error('is_dibayar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.jenis-cuti.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
