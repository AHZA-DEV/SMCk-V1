@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2>Data Karyawan</h2>
                    <p class="text-muted">Informasi karyawan dan sisa cuti</p>
                </div>
                <a href="{{ route('hrd.data-karyawan.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Karyawan
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Karyawan</h5>
                <div>
                    <form method="GET" action="{{ route('hrd.data-karyawan.index') }}" class="d-inline">
                        <div class="input-group" style="width: 300px;">
                            <input type="text" name="search" class="form-control" placeholder="Cari karyawan..." value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Departemen</th>
                            <th>Jabatan</th>
                            <th>Sisa Cuti</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($karyawans as $index => $karyawan)
                        <tr>
                            <td>{{ $karyawans->firstItem() + $index }}</td>
                            <td>{{ $karyawan->nip }}</td>
                            <td>{{ $karyawan->nama }}</td>
                            <td>{{ $karyawan->email }}</td>
                            <td>{{ $karyawan->departemen->nama_departemen ?? '-' }}</td>
                            <td>{{ $karyawan->jabatan }}</td>
                            <td>{{ $karyawan->sisaCutiTahunan->where('tahun', date('Y'))->first()->sisa_cuti ?? 0 }} hari</td>
                            <td>
                                <div class="d-flex  gap-2">
                                    <a href="{{ route('hrd.data-karyawan.show', $karyawan->id) }}" class="btn btn-sm btn-info" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('hrd.data-karyawan.edit', $karyawan->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('hrd.data-karyawan.destroy', $karyawan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data karyawan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">Tidak ada data karyawan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $karyawans->links() }}
            </div>
        </div>
    </div>
</div>
@endsection