
@extends('layouts.app')

@push('styles')
<style>
    .chart-container {
        position: relative;
        height: 300px;
        margin-bottom: 1rem;
    }
</style>
@endpush

@section('content')
<div class="welcome-section">
    <h2>Selamat Datang, {{ Auth::guard('web')->user()->name ?? 'Administrator' }}!</h2>
    <p class="text-muted">Dashboard Administrator - Sistem Manajemen Cuti</p>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card ">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Total Karyawan</h6>
                <h2 class="card-title">{{ $totalKaryawan }}</h2>
                <p class="mb-0"><i class="bi bi-people"></i> Active Users</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Pengajuan Cuti</h6>
                <h2 class="card-title">{{ $cutiPending }}</h2>
                <p class="mb-0"><i class="bi bi-calendar-check"></i> Pending</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Cuti Disetujui</h6>
                <h2 class="card-title">{{ $cutiDisetujui }}</h2>
                <p class="mb-0"><i class="bi bi-check-circle"></i> Tahun Ini</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Departemen</h6>
                <h2 class="card-title">{{ $totalDepartemen }}</h2>
                <p class="mb-0"><i class="bi bi-building"></i> Active</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Statistik Cuti Bulanan</h5>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="cutiMonthlyChart"></canvas>
                </div>
            </div>
        </div>
        
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">Distribusi Status Cuti</h5>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="cutiStatusChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Pengajuan Terbaru</h5>
            </div>
            <div class="card-body">
                @forelse($cutiTerbaru as $cuti)
                <div class="order-item">
                    <div class="d-flex justify-content-between">
                        <span>{{ $cuti->karyawan->nama ?? 'N/A' }}</span>
                        @if($cuti->status == 'pending')
                            <span class="badge bg-warning">Pending</span>
                        @elseif($cuti->status == 'disetujui')
                            <span class="badge bg-success">Disetujui</span>
                        @elseif($cuti->status == 'ditolak')
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </div>
                    <small class="text-muted">
                        {{ $cuti->jenisCuti->nama_jenis ?? 'N/A' }} - 
                        {{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->diffInDays(\Carbon\Carbon::parse($cuti->tanggal_selesai)) + 1 }} hari
                    </small>
                    <small class="text-muted d-block">{{ $cuti->created_at->diffForHumans() }}</small>
                </div>
                @empty
                <p class="text-muted text-center">Belum ada pengajuan cuti</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Data untuk chart bulanan
    @php
        $monthlyStats = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyStats[] = [
                'month' => date('M', mktime(0, 0, 0, $i, 1)),
                'disetujui' => \App\Models\Cuti::where('status', 'disetujui')
                    ->whereMonth('tanggal_mulai', $i)
                    ->whereYear('tanggal_mulai', date('Y'))
                    ->count(),
                'ditolak' => \App\Models\Cuti::where('status', 'ditolak')
                    ->whereMonth('tanggal_mulai', $i)
                    ->whereYear('tanggal_mulai', date('Y'))
                    ->count(),
                'pending' => \App\Models\Cuti::where('status', 'pending')
                    ->whereMonth('tanggal_mulai', $i)
                    ->whereYear('tanggal_mulai', date('Y'))
                    ->count(),
            ];
        }
        $totalCuti = \App\Models\Cuti::count();
        $cutiPending = \App\Models\Cuti::where('status', 'pending')->count();
        $cutiDisetujui = \App\Models\Cuti::where('status', 'disetujui')->count();
        $cutiDitolak = \App\Models\Cuti::where('status', 'ditolak')->count();
    @endphp

    const monthlyData = @json($monthlyStats);
    
    // Chart Bulanan - Line Chart
    const ctxMonthly = document.getElementById('cutiMonthlyChart').getContext('2d');
    const monthlyChart = new Chart(ctxMonthly, {
        type: 'line',
        data: {
            labels: monthlyData.map(item => item.month),
            datasets: [
                {
                    label: 'Disetujui',
                    data: monthlyData.map(item => item.disetujui),
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Pending',
                    data: monthlyData.map(item => item.pending),
                    borderColor: '#f59e0b',
                    backgroundColor: 'rgba(245, 158, 11, 0.1)',
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Ditolak',
                    data: monthlyData.map(item => item.ditolak),
                    borderColor: '#ef4444',
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    tension: 0.4,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });

    // Chart Status - Doughnut Chart
    const ctxStatus = document.getElementById('cutiStatusChart').getContext('2d');
    const statusChart = new Chart(ctxStatus, {
        type: 'doughnut',
        data: {
            labels: ['Disetujui', 'Pending', 'Ditolak'],
            datasets: [{
                data: [{{ $cutiDisetujui }}, {{ $cutiPending }}, {{ $cutiDitolak }}],
                backgroundColor: [
                    '#10b981',
                    '#f59e0b',
                    '#ef4444'
                ],
                borderWidth: 2,
                borderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            let value = context.parsed || 0;
                            let total = {{ $totalCuti }};
                            let percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                            return label + ': ' + value + ' (' + percentage + '%)';
                        }
                    }
                }
            }
        }
    });

    // Update chart theme based on dark mode
    function updateChartTheme() {
        const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
        const textColor = isDark ? '#f1f5f9' : '#1e293b';
        const gridColor = isDark ? '#334155' : '#e2e8f0';

        [monthlyChart, statusChart].forEach(chart => {
            chart.options.plugins.legend.labels.color = textColor;
            if (chart.options.scales) {
                chart.options.scales.x.ticks.color = textColor;
                chart.options.scales.y.ticks.color = textColor;
                chart.options.scales.x.grid.color = gridColor;
                chart.options.scales.y.grid.color = gridColor;
            }
            chart.update();
        });
    }

    // Initial theme update
    updateChartTheme();

    // Listen for theme changes
    const observer = new MutationObserver(updateChartTheme);
    observer.observe(document.documentElement, {
        attributes: true,
        attributeFilter: ['data-theme']
    });
});
</script>
@endpush
