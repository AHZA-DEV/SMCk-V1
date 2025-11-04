<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Departemen;
use App\Models\JenisCuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Cuti::with(['karyawan', 'jenisCuti', 'karyawan.departemen']);

        // Filter berdasarkan periode
        if ($request->has('periode')) {
            switch ($request->periode) {
                case 'bulan_ini':
                    $query->whereMonth('tanggal_mulai', now()->month)
                          ->whereYear('tanggal_mulai', now()->year);
                    break;
                case '3_bulan':
                    $query->where('tanggal_mulai', '>=', now()->subMonths(3));
                    break;
                case '6_bulan':
                    $query->where('tanggal_mulai', '>=', now()->subMonths(6));
                    break;
                case '1_tahun':
                    $query->where('tanggal_mulai', '>=', now()->subYear());
                    break;
            }
        }

        // Filter berdasarkan departemen
        if ($request->has('departemen_id') && $request->departemen_id) {
            $query->whereHas('karyawan', function ($q) use ($request) {
                $q->where('departemen_id', $request->departemen_id);
            });
        }

        // Filter berdasarkan jenis cuti
        if ($request->has('jenis_cuti_id') && $request->jenis_cuti_id) {
            $query->where('jenis_cuti_id', $request->jenis_cuti_id);
        }

        $cutis = $query->orderBy('tanggal_mulai', 'desc')->paginate(15);
        $departemens = Departemen::all();
        $jenisCutis = JenisCuti::all();

        // Statistik
        $statistik = [
            'total_cuti' => Cuti::count(),
            'disetujui' => Cuti::where('status', 'disetujui')->count(),
            'ditolak' => Cuti::where('status', 'ditolak')->count(),
            'pending' => Cuti::where('status', 'pending')->count(),
        ];

        return view('admin.laporan.index', compact('cutis', 'departemens', 'jenisCutis', 'statistik'));
    }
}
