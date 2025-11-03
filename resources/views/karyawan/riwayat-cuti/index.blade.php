
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
                    <i class="bi bi-person-circle" style="font-size: 100px; color: #6c757d;"></i>
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
                    <form>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Depan</label>
                                <input type="text" class="form-control" value="{{ Auth::guard('karyawan')->user()->nama_depan }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nama Belakang</label>
                                <input type="text" class="form-control" value="{{ Auth::guard('karyawan')->user()->nama_belakang }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="{{ Auth::guard('karyawan')->user()->email }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" value="{{ Auth::guard('karyawan')->user()->nomor_telepon }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" rows="3">{{ Auth::guard('karyawan')->user()->alamat }}</textarea>
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
