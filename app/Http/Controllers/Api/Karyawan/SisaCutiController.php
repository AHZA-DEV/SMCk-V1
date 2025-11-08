<?php

namespace App\Http\Controllers\Api\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\SisaCutiTahunan;
use Illuminate\Http\Request;

class SisaCutiController extends Controller
{
    public function index(Request $request)
    {
        $karyawan = $request->user();
        
        $sisaCutiTahunan = SisaCutiTahunan::where('karyawan_id', $karyawan->id)
            ->orderBy('tahun', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'sisa_cuti_saat_ini' => $karyawan->sisa_cuti,
                'riwayat_sisa_cuti' => $sisaCutiTahunan
            ]
        ]);
    }
}
