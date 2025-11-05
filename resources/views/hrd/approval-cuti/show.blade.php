
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2>Detail Pengajuan Cuti</h2>
                    <p class="text-muted">Detail informasi pengajuan cuti karyawan</p>
                </div>
                <a href="{{ route('hrd.approval-cuti.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Cuti</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th width="200">Nama Karyawan</th>
                            <td>{{ $cuti->karyawan->nama }}</td>
                        </tr>
                        <tr>
                            <th>NIP</th>
                            <td>{{ $cuti->karyawan->nip }}</td>
                        </tr>
                        <tr>
                            <th>Departemen</th>
                            <td>{{ $cuti->karyawan->departemen->nama_departemen ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Jabatan</th>
                            <td>{{ $cuti->karyawan->jabatan }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Cuti</th>
                            <td>{{ $cuti->jenisCuti->nama_cuti }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Mulai</th>
                            <td>{{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Selesai</th>
                            <td>{{ \Carbon\Carbon::parse($cuti->tanggal_selesai)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Durasi</th>
                            <td>{{ $cuti->jumlah_hari }} hari</td>
                        </tr>
                        <tr>
                            <th>Alasan</th>
                            <td>{{ $cuti->alasan }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($cuti->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($cuti->status == 'disetujui')
                                    <span class="badge bg-success">Disetujui</span>
                                @else
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                        </tr>
                        @if($cuti->file_pendukung)
                        <tr>
                            <th>File Pendukung</th>
                            <td>
                                <a href="{{ asset('storage/' . $cuti->file_pendukung) }}" target="_blank" class="btn btn-sm btn-info">
                                    <i class="bi bi-file-earmark"></i> Lihat File
                                </a>
                            </td>
                        </tr>
                        @endif
                        @if($cuti->catatan_approver)
                        <tr>
                            <th>Catatan Approver</th>
                            <td>{{ $cuti->catatan_approver }}</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>

        @if($cuti->status == 'pending')
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Approval</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('hrd.approval-cuti.approve', $cuti->id) }}" method="POST" class="mb-3">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Catatan (Opsional)</label>
                            <textarea name="catatan_approver" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success w-100">
                            <i class="bi bi-check-circle"></i> Setujui Cuti
                        </button>
                    </form>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">Tolak Cuti</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('hrd.approval-cuti.reject', $cuti->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Alasan Penolakan <span class="text-danger">*</span></label>
                            <textarea name="catatan_approver" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="bi bi-x-circle"></i> Tolak Cuti
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
