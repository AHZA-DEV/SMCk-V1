
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2>Detail Pengajuan Cuti</h2>
                    <p class="text-muted">Informasi detail pengajuan cuti</p>
                </div>
                <a href="{{ route('hrd.pengajuan-cuti.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Informasi Pengajuan</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
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
                            <th>Jenis Cuti</th>
                            <td>{{ $cuti->jenisCuti->nama_cuti }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Pengajuan</th>
                            <td>{{ \Carbon\Carbon::parse($cuti->created_at)->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table">
                        <tr>
                            <th width="200">Tanggal Mulai</th>
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
                        @if($cuti->tanggal_approve)
                        <tr>
                            <th>Tanggal Approve</th>
                            <td>{{ \Carbon\Carbon::parse($cuti->tanggal_approve)->format('d/m/Y H:i') }}</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12">
                    <h6>Alasan Cuti</h6>
                    <p>{{ $cuti->alasan }}</p>
                </div>

                @if($cuti->catatan_approver)
                <div class="col-12 mt-3">
                    <h6>Catatan Approver</h6>
                    <p>{{ $cuti->catatan_approver }}</p>
                </div>
                @endif

                @if($cuti->file_pendukung)
                <div class="col-12 mt-3">
                    <h6>File Pendukung</h6>
                    <a href="{{ asset('storage/' . $cuti->file_pendukung) }}" target="_blank" class="btn btn-info">
                        <i class="bi bi-file-earmark"></i> Lihat File
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
