@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h2>Tambah Departemen Baru</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.departemen.index') }}">Kelola Departemen</a></li>
            <li class="breadcrumb-item active">Tambah Departemen</li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.departemen.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="kode_departemen" class="form-label">Kode Departemen <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('kode_departemen') is-invalid @enderror" 
                       id="kode_departemen" name="kode_departemen" value="{{ old('kode_departemen') }}" 
                       placeholder="Contoh: IT, HRD, FIN" required>
                @error('kode_departemen')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nama_departemen" class="form-label">Nama Departemen <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('nama_departemen') is-invalid @enderror" 
                       id="nama_departemen" name="nama_departemen" value="{{ old('nama_departemen') }}" 
                       placeholder="Contoh: Teknologi Informasi" required>
                @error('nama_departemen')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                          id="deskripsi" name="deskripsi" rows="4" 
                          placeholder="Deskripsi departemen (opsional)">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.departemen.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
