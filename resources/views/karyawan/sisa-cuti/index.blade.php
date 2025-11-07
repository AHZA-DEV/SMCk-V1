
@extends('layouts.app')

@push('styles')
<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2>Sisa Cuti</h2>
            <p class="text-muted">Informasi sisa cuti Anda</p>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card stat-card stat-card-blue">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Sisa Cuti Tahunan</h6>
                    <h2 class="card-title">{{ Auth::guard('karyawan')->user()->sisa_cuti }}</h2>
                    <p class="mb-0"><i class="bi bi-calendar-event"></i> Hari</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card stat-card stat-card-purple">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Cuti Terpakai</h6>
                    <h2 class="card-title">{{ 12 - Auth::guard('karyawan')->user()->sisa_cuti }}</h2>
                    <p class="mb-0"><i class="bi bi-calendar-check"></i> Hari</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card stat-card stat-card-indigo">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Total Jatah Cuti</h6>
                    <h2 class="card-title">12</h2>
                    <p class="mb-0"><i class="bi bi-calendar-range"></i> Hari/Tahun</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Detail Penggunaan Cuti</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="cutiTable" class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Jenis Cuti</th>
                            <th>Jatah</th>
                            <th>Terpakai</th>
                            <th>Sisa</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Cuti Tahunan</td>
                            <td>12 hari</td>
                            <td>{{ 12 - Auth::guard('karyawan')->user()->sisa_cuti }} hari</td>
                            <td>{{ Auth::guard('karyawan')->user()->sisa_cuti }} hari</td>
                            <td>
                                @if(Auth::guard('karyawan')->user()->sisa_cuti > 6)
                                    <span class="badge bg-success">Banyak</span>
                                @elseif(Auth::guard('karyawan')->user()->sisa_cuti > 3)
                                    <span class="badge bg-warning">Sedang</span>
                                @else
                                    <span class="badge bg-danger">Sedikit</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-0">Informasi</h5>
        </div>
        <div class="card-body">
            <p class="mb-1">- Jatah cuti tahunan adalah 12 hari per tahun</p>
            <p class="mb-1">- Sisa cuti yang tidak digunakan tidak dapat dibawa ke tahun berikutnya</p>
            <p class="mb-1">- Cuti sakit dan cuti darurat tidak mengurangi jatah cuti tahunan</p>
            <p class="mb-0">- Pengajuan cuti harus dilakukan minimal 3 hari sebelum tanggal mulai cuti</p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<!-- DataTables Buttons -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
    $('#cutiTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="bi bi-file-excel"></i> Export Excel',
                className: 'btn btn-success btn-sm',
                title: 'Data Sisa Cuti - {{ Auth::guard("karyawan")->user()->nama_depan }} {{ Auth::guard("karyawan")->user()->nama_belakang }}',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bi bi-file-pdf"></i> Export PDF',
                className: 'btn btn-danger btn-sm',
                title: 'Data Sisa Cuti - {{ Auth::guard("karyawan")->user()->nama_depan }} {{ Auth::guard("karyawan")->user()->nama_belakang }}',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'print',
                text: '<i class="bi bi-printer"></i> Print',
                className: 'btn btn-info btn-sm',
                title: 'Data Sisa Cuti - {{ Auth::guard("karyawan")->user()->nama_depan }} {{ Auth::guard("karyawan")->user()->nama_belakang }}',
                exportOptions: {
                    columns: ':visible'
                }
            }
        ],
        language: {
            search: "Pencarian:",
            lengthMenu: "Tampilkan _MENU_ data per halaman",
            zeroRecords: "Data tidak ditemukan",
            info: "Menampilkan halaman _PAGE_ dari _PAGES_",
            infoEmpty: "Tidak ada data tersedia",
            infoFiltered: "(difilter dari _MAX_ total data)",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "Selanjutnya",
                previous: "Sebelumnya"
            }
        },
        paging: false,
        searching: false,
        info: false
    });
});
</script>
@endpush
