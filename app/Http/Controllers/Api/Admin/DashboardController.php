<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\Cuti;
use App\Models\Departemen;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKaryawan = Karyawan::count();
        $totalDepartemen = Departemen::count();
        $cutiPending = Cuti::where('status', 'pending')->count();
        $cutiDisetujui = Cuti::where('status', 'disetujui')
            ->whereYear('tanggal_mulai', date('Y'))
            ->count();
        
        $cutiTerbaru = Cuti::with(['karyawan', 'jenisCuti'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'total_karyawan' => $totalKaryawan,
                'total_departemen' => $totalDepartemen,
                'cuti_pending' => $cutiPending,
                'cuti_disetujui' => $cutiDisetujui,
                'cuti_terbaru' => $cutiTerbaru
            ]
        ]);
    }
}
