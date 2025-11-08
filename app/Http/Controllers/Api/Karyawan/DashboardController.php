<?php

namespace App\Http\Controllers\Api\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $karyawan = $request->user();
        
        $totalCutiDiajukan = Cuti::where('karyawan_id', $karyawan->id)
            ->where('status', 'pending')
            ->count();
            
        $totalCutiDisetujui = Cuti::where('karyawan_id', $karyawan->id)
            ->where('status', 'disetujui')
            ->count();
            
        $totalCutiDitolak = Cuti::where('karyawan_id', $karyawan->id)
            ->where('status', 'ditolak')
            ->count();

        $riwayatCutiTerbaru = Cuti::where('karyawan_id', $karyawan->id)
            ->with('jenisCuti')
            ->latest()
            ->take(5)
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'karyawan' => $karyawan->load('departemen'),
                'statistik' => [
                    'sisa_cuti' => $karyawan->sisa_cuti,
                    'total_cuti_diajukan' => $totalCutiDiajukan,
                    'total_cuti_disetujui' => $totalCutiDisetujui,
                    'total_cuti_ditolak' => $totalCutiDitolak
                ],
                'riwayat_cuti_terbaru' => $riwayatCutiTerbaru
            ]
        ]);
    }
}
