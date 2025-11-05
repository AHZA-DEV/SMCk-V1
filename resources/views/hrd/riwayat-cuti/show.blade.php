
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2>Detail Riwayat Cuti</h2>
                    <p class="text-muted">Informasi detail riwayat cuti</p>
                </div>
                <a href="{{ route('hrd.riwayat-cuti.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Informasi Cuti</h5>
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
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table">
                        <tr>
                            <th width="200">Periode</th>
                            <td>{{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($cuti->tanggal_selesai)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Durasi</th>
                            <td>{{ $cuti->jumlah_hari }} hari</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($cuti->status == 'disetujui')
                                    <span class="badge bg-success">Disetujui</span>
                                @else
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Disetujui Oleh</th>
                            <td>{{ $cuti->disetujui_oleh ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Persetujuan</th>
                            <td>{{ $cuti->tanggal_approve ? \Carbon\Carbon::parse($cuti->tanggal_approve)->format('d/m/Y') : '-' }}</td>
                        </tr>
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
            </div>
        </div>
    </div>
</div>
@endsection
