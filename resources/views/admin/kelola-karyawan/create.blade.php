
@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h2>Tambah Karyawan Baru</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.karyawan.index') }}">Kelola Karyawan</a></li>
            <li class="breadcrumb-item active">Tambah Karyawan</li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.karyawan.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nip" class="form-label">NIP <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nip') is-invalid @enderror" 
                               id="nip" name="nip" value="{{ old('nip') }}" required>
                        @error('nip')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                       id="nama" name="nama" value="{{ old('nama') }}" required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" 
                               id="password_confirmation" name="password_confirmation" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="id_departemen" class="form-label">Departemen <span class="text-danger">*</span></label>
                        <select class="form-select @error('id_departemen') is-invalid @enderror" 
                                id="id_departemen" name="id_departemen" required>
                            <option value="">Pilih Departemen</option>
                            @foreach($departemens as $departemen)
                                <option value="{{ $departemen->id }}" {{ old('id_departemen') == $departemen->id ? 'selected' : '' }}>
                                    {{ $departemen->nama_departemen }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_departemen')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="jabatan" class="form-label">Jabatan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('jabatan') is-invalid @enderror" 
                               id="jabatan" name="jabatan" value="{{ old('jabatan') }}" required>
                        @error('jabatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tanggal_mulai_kerja" class="form-label">Tanggal Mulai Kerja <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('tanggal_mulai_kerja') is-invalid @enderror" 
                               id="tanggal_mulai_kerja" name="tanggal_mulai_kerja" value="{{ old('tanggal_mulai_kerja') }}" required>
                        @error('tanggal_mulai_kerja')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="no_telepon" class="form-label">No Telepon</label>
                        <input type="text" class="form-control @error('no_telepon') is-invalid @enderror" 
                               id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}">
                        @error('no_telepon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control @error('alamat') is-invalid @enderror" 
                          id="alamat" name="alamat" rows="3">{{ old('alamat') }}</textarea>
                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="peran" class="form-label">Peran <span class="text-danger">*</span></label>
                        <select class="form-select @error('peran') is-invalid @enderror" 
                                id="peran" name="peran" required>
                            <option value="">Pilih Peran</option>
                            <option value="karyawan" {{ old('peran') == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                            <option value="hrd" {{ old('peran') == 'hrd' ? 'selected' : '' }}>HRD</option>
                        </select>
                        @error('peran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="sisa_cuti" class="form-label">Sisa Cuti (hari)</label>
                        <input type="number" class="form-control @error('sisa_cuti') is-invalid @enderror" 
                               id="sisa_cuti" name="sisa_cuti" value="{{ old('sisa_cuti', 12) }}" min="0">
                        @error('sisa_cuti')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.karyawan.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
