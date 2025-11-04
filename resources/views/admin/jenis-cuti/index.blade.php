
@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Kelola Jenis Cuti</h2>
    <a href="{{ route('admin.jenis-cuti.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Tambah Jenis Cuti
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
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Jenis Cuti</th>
                        <th>Maksimal Hari</th>
                        <th>Status Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jenisCutis as $index => $jenisCuti)
                    <tr>
                        <td>{{ $jenisCutis->firstItem() + $index }}</td>
                        <td><span class="badge bg-info">{{ $jenisCuti->kode_cuti }}</span></td>
                        <td>{{ $jenisCuti->nama_cuti }}</td>
                        <td>{{ $jenisCuti->maksimal_hari ? $jenisCuti->maksimal_hari . ' hari' : 'Tidak ada batas' }}</td>
                        <td>
                            <span class="badge bg-{{ $jenisCuti->is_dibayar ? 'success' : 'secondary' }}">
                                {{ $jenisCuti->is_dibayar ? 'Dibayar' : 'Tidak Dibayar' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.jenis-cuti.show', $jenisCuti->id) }}" class="btn btn-sm btn-info" title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('admin.jenis-cuti.edit', $jenisCuti->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.jenis-cuti.destroy', $jenisCuti->id) }}" method="POST" class="d-inline" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus jenis cuti ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data jenis cuti</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            {{ $jenisCutis->links() }}
        </div>
    </div>
</div>
@endsection
