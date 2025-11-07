<?php

namespace App\Http\Controllers\Api\Hrd;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use App\Models\Departemen;
use App\Models\JenisCuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->bulan ?? now()->month;
        $tahun = $request->tahun ?? now()->year;
        $departemenId = $request->departemen_id;

        $query = Cuti::with(['karyawan.departemen', 'jenisCuti'])
            ->whereYear('tanggal_mulai', $tahun)
            ->whereMonth('tanggal_mulai', $bulan);

        if ($departemenId) {
            $query->whereHas('karyawan', function ($q) use ($departemenId) {
                $q->where('departemen_id', $departemenId);
            });
        }

        $laporan = $query->get();

        $statistik = [
            'total_pengajuan' => $laporan->count(),
            'disetujui' => $laporan->where('status', 'disetujui')->count(),
            'ditolak' => $laporan->where('status', 'ditolak')->count(),
            'pending' => $laporan->where('status', 'pending')->count(),
        ];

        $per_jenis_cuti = $laporan->groupBy('jenis_cuti_id')->map(function ($items, $jenisId) {
            return [
                'jenis_cuti' => $items->first()->jenisCuti->nama_cuti ?? 'Unknown',
                'jumlah' => $items->count(),
                'disetujui' => $items->where('status', 'disetujui')->count(),
                'ditolak' => $items->where('status', 'ditolak')->count(),
            ];
        })->values();

        $per_departemen = $laporan->groupBy('karyawan.departemen_id')->map(function ($items, $deptId) {
            return [
                'departemen' => $items->first()->karyawan->departemen->nama_departemen ?? 'Unknown',
                'jumlah' => $items->count(),
                'disetujui' => $items->where('status', 'disetujui')->count(),
                'ditolak' => $items->where('status', 'ditolak')->count(),
            ];
        })->values();

        return response()->json([
            'success' => true,
            'data' => [
                'periode' => [
                    'bulan' => $bulan,
                    'tahun' => $tahun
                ],
                'statistik' => $statistik,
                'per_jenis_cuti' => $per_jenis_cuti,
                'per_departemen' => $per_departemen,
                'detail' => $laporan
            ]
        ]);
    }

    public function export(Request $request)
    {
        $bulan = $request->bulan ?? now()->month;
        $tahun = $request->tahun ?? now()->year;
        $departemenId = $request->departemen_id;

        $query = Cuti::with(['karyawan.departemen', 'jenisCuti', 'disetujuiOleh'])
            ->whereYear('tanggal_mulai', $tahun)
            ->whereMonth('tanggal_mulai', $bulan);

        if ($departemenId) {
            $query->whereHas('karyawan', function ($q) use ($departemenId) {
                $q->where('departemen_id', $departemenId);
            });
        }

        $data = $query->get();

        return response()->json([
            'success' => true,
            'message' => 'Data laporan siap untuk export',
            'data' => $data
        ]);
    }
}
