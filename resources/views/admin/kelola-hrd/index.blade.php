@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Kelola HRD</h2>
</div>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <input type="text" class="form-control" id="searchHRD" placeholder="Cari HRD...">
            </div>
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
                        <th>Tanggal Bergabung</th>
                        
                    </tr>
                </thead>
                <tbody id="hrdTableBody">
                    @forelse($hrds as $index => $hrd)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $hrd->nip }}</td>
                        <td>{{ $hrd->nama }}</td>
                        <td>{{ $hrd->email }}</td>
                        <td>{{ $hrd->departemen->nama_departemen ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($hrd->tanggal_mulai_kerja)->format('d/m/Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data HRD</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('searchHRD').addEventListener('keyup', function() {
    let searchValue = this.value.toLowerCase();
    let tableRows = document.querySelectorAll('#hrdTableBody tr');
    
    tableRows.forEach(row => {
        let text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchValue) ? '' : 'none';
    });
});
</script>
@endpush
@endsection
