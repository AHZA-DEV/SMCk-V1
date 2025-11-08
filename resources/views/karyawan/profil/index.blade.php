
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2>Profil Saya</h2>
            <p class="text-muted">Kelola informasi profil Anda</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    @if(Auth::guard('karyawan')->user()->foto_profil)
                        <img src="{{ asset('storage/' . Auth::guard('karyawan')->user()->foto_profil) }}" alt="Profile" class="rounded-circle" width="100" height="100" style="object-fit: cover;">
                    @else
                        <i class="bi bi-person-circle" style="font-size: 100px; color: #6c757d;"></i>
                    @endif
                    <h4 class="mt-3">{{ Auth::guard('karyawan')->user()->nama_depan }} {{ Auth::guard('karyawan')->user()->nama_belakang }}</h4>
                    <p class="text-muted">{{ Auth::guard('karyawan')->user()->peran }}</p>
                    <p class="text-muted"><i class="bi bi-envelope"></i> {{ Auth::guard('karyawan')->user()->email }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Pribadi</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('karyawan.profil.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label">Foto Profil</label>
                            <input type="file" name="foto_profil" class="form-control" accept="image/*">
                            <small class="text-muted">Format: JPG, PNG, maksimal 2MB</small>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Depan</label>
                                <input type="text" name="nama_depan" class="form-control" value="{{ old('nama_depan', Auth::guard('karyawan')->user()->nama_depan) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nama Belakang</label>
                                <input type="text" name="nama_belakang" class="form-control" value="{{ old('nama_belakang', Auth::guard('karyawan')->user()->nama_belakang) }}" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', Auth::guard('karyawan')->user()->email) }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="text" name="no_telepon" class="form-control" value="{{ old('no_telepon', Auth::guard('karyawan')->user()->no_telepon) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3">{{ old('alamat', Auth::guard('karyawan')->user()->alamat) }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
