@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Kelola Karyawan</h2>
    <a href="{{ route('admin.karyawan.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Tambah Karyawan
    </a>
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

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <input type="text" class="form-control" placeholder="Cari karyawan...">
            </div>
            <!-- <div class="col-md-3">
                <select class="form-select">
                    <option value="">Semua Departemen</option>
                    <option>IT</option>
                    <option>HRD</option>
                    <option>Finance</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option value="">Semua Status</option>
                    <option>Aktif</option>
                    <option>Non-Aktif</option>
                </select>
            </div> -->
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Departemen</th>
                        <th>Jabatan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($karyawans as $index => $karyawan)
                    <tr>
                        <td>{{ $karyawans->firstItem() + $index }}</td>
                        <td>{{ $karyawan->nip }}</td>
                        <td>{{ $karyawan->nama_lengkap }}</td>
                        <td>{{ $karyawan->email }}</td>
                        <td>{{ $karyawan->departemen->nama_departemen ?? '-' }}</td>
                        <td>{{ $karyawan->jabatan }}</td>
                        <td>
                            <span class="badge bg-{{ $karyawan->peran == 'hrd' ? 'primary' : 'success' }}">
                                {{ strtoupper($karyawan->peran) }}
                            </span>
                        </td>
                        <td class="">
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.karyawan.show', $karyawan->id) }}" class="btn btn-sm btn-info" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.karyawan.edit', $karyawan->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.karyawan.destroy', $karyawan->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus karyawan ini?')">
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
                        <td colspan="8" class="text-center">Belum ada data karyawan</td>
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
@endsection