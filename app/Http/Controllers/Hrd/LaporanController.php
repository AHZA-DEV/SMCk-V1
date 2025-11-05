<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use App\Models\Departemen;
use App\Models\JenisCuti;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Cuti::with(['karyawan.departemen', 'jenisCuti']);

        // Filter periode
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

        // Filter departemen
        if ($request->has('departemen_id') && $request->departemen_id != '') {
            $query->whereHas('karyawan', function($q) use ($request) {
                $q->where('departemen_id', $request->departemen_id);
            });
        }

        // Filter jenis cuti
        if ($request->has('jenis_cuti_id') && $request->jenis_cuti_id != '') {
            $query->where('jenis_cuti_id', $request->jenis_cuti_id);
        }

        $cutis = $query->orderBy('tanggal_mulai', 'desc')->paginate(15);
        $departemens = Departemen::all();
        $jenisCutis = JenisCuti::all();

        $statistik = [
            'total_pengajuan' => Cuti::whereMonth('created_at', now()->month)->count(),
            'disetujui' => Cuti::where('status', 'disetujui')
                ->whereMonth('tanggal_approve', now()->month)->count(),
            'ditolak' => Cuti::where('status', 'ditolak')
                ->whereMonth('tanggal_approve', now()->month)->count(),
            'pending' => Cuti::where('status', 'pending')->count(),
        ];

        return view('hrd.laporan.index', compact('cutis', 'departemens', 'jenisCutis', 'statistik'));
    }
}
