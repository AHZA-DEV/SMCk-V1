<?php

namespace App\Http\Controllers\Api\Hrd;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'pending' => Cuti::where('status', 'pending')->count(),
            'disetujui_hari_ini' => Cuti::where('status', 'disetujui')
                ->whereDate('tanggal_approve', today())
                ->count(),
            'ditolak_bulan_ini' => Cuti::where('status', 'ditolak')
                ->whereMonth('tanggal_approve', now()->month)
                ->count(),
            'total_karyawan' => Karyawan::where('status', 'aktif')->count(),
        ];

        $pengajuanCuti = Cuti::with(['karyawan.departemen', 'jenisCuti'])
            ->where('status', 'pending')
            ->latest()
            ->take(10)
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'stats' => $stats,
                'pengajuan_terbaru' => $pengajuanCuti
            ]
        ]);
    }
}
