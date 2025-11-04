@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h2>Detail Pengajuan Cuti</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.cuti.index') }}">Kelola Cuti</a></li>
            <li class="breadcrumb-item active">Detail Pengajuan</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Informasi Pengajuan Cuti</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">Nama Karyawan</th>
                        <td>{{ $cuti->karyawan->nama_lengkap }}</td>
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
                        <td>{{ $cuti->tanggal_mulai->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Selesai</th>
                        <td>{{ $cuti->tanggal_selesai->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah Hari</th>
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
                    @if($cuti->status != 'pending')
                    <tr>
                        <th>Disetujui Oleh</th>
                        <td>{{ $cuti->disetujuiOleh->nama_lengkap ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Disetujui</th>
                        <td>{{ $cuti->disetujui_pada ? $cuti->disetujui_pada->format('d F Y H:i') : '-' }}</td>
                    </tr>
                    @endif
                    @if($cuti->alasan_penolakan)
                    <tr>
                        <th>Alasan Penolakan</th>
                        <td>{{ $cuti->alasan_penolakan }}</td>
                    </tr>
                    @endif
                    <tr>
                        <th>Tanggal Pengajuan</th>
                        <td>{{ $cuti->created_at->format('d F Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-3">
            <a href="{{ route('admin.cuti.index') }}" class="btn btn-secondary">Kembali</a>
            @if($cuti->status == 'pending')
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#approveModal">
                <i class="bi bi-check-circle me-2"></i>Setujui
            </button>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">
                <i class="bi bi-x-circle me-2"></i>Tolak
            </button>
            @endif
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Sisa Cuti Karyawan</h5>
            </div>
            <div class="card-body text-center">
                <div class="mb-3">
                    <i class="bi bi-calendar-check" style="font-size: 60px; color: #4e73df;"></i>
                </div>
                <h2>{{ $cuti->karyawan->sisa_cuti }}</h2>
                <p class="text-muted">Hari Tersisa</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal Approve -->
<div class="modal fade" id="approveModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.cuti.updateStatus', $cuti->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="disetujui">
                <div class="modal-header">
                    <h5 class="modal-title">Setujui Pengajuan Cuti</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menyetujui pengajuan cuti ini?</p>
                    <div class="mb-3">
                        <label for="catatan_approver" class="form-label">Catatan (Opsional)</label>
                        <textarea class="form-control" id="catatan_approver" name="catatan_approver" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Setujui</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Reject -->
<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.cuti.updateStatus', $cuti->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="ditolak">
                <div class="modal-header">
                    <h5 class="modal-title">Tolak Pengajuan Cuti</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menolak pengajuan cuti ini?</p>
                    <div class="mb-3">
                        <label for="alasan_penolakan" class="form-label">Alasan Penolakan <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="alasan_penolakan" name="alasan_penolakan" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Tolak</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
