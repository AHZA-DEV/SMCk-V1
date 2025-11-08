<?php

namespace App\Http\Controllers\Api\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use Illuminate\Http\Request;

class RiwayatCutiController extends Controller
{
    public function index(Request $request)
    {
        $karyawan = $request->user();
        
        $query = Cuti::where('karyawan_id', $karyawan->id)
            ->with(['jenisCuti', 'disetujuiOleh']);

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('tahun') && $request->tahun != '') {
            $query->whereYear('tanggal_mulai', $request->tahun);
        }

        $riwayatCuti = $query->latest()->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $riwayatCuti
        ]);
    }

    public function show(Request $request, $id)
    {
        $karyawan = $request->user();
        
        $cuti = Cuti::where('karyawan_id', $karyawan->id)
            ->with(['jenisCuti', 'disetujuiOleh'])
            ->find($id);

        if (!$cuti) {
            return response()->json([
                'success' => false,
                'message' => 'Data cuti tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $cuti
        ]);
    }
}
