<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use App\Models\Karyawan;
use App\Models\Departemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type', 'cuti');
        
        switch ($type) {
            case 'cuti':
                return $this->laporanCuti($request);
            case 'karyawan':
                return $this->laporanKaryawan($request);
            case 'departemen':
                return $this->laporanDepartemen($request);
            default:
                return response()->json([
                    'success' => false,
                    'message' => 'Tipe laporan tidak valid'
                ], 400);
        }
    }

    private function laporanCuti($request)
    {
        $query = Cuti::with(['karyawan', 'jenisCuti']);

        if ($request->filled('start_date')) {
            $query->where('tanggal_mulai', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->where('tanggal_selesai', '<=', $request->end_date);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('departemen_id')) {
            $query->whereHas('karyawan', function($q) use ($request) {
                $q->where('departemen_id', $request->departemen_id);
            });
        }

        $data = $query->orderBy('created_at', 'desc')->get();

        $summary = [
            'total' => $data->count(),
            'disetujui' => $data->where('status', 'disetujui')->count(),
            'ditolak' => $data->where('status', 'ditolak')->count(),
            'pending' => $data->where('status', 'pending')->count(),
        ];

        return response()->json([
            'success' => true,
            'data' => $data,
            'summary' => $summary
        ]);
    }

    private function laporanKaryawan($request)
    {
        $query = Karyawan::with(['departemen', 'cuti']);

        if ($request->filled('departemen_id')) {
            $query->where('departemen_id', $request->departemen_id);
        }

        if ($request->filled('peran')) {
            $query->where('peran', $request->peran);
        }

        $data = $query->get();

        $summary = [
            'total_karyawan' => $data->count(),
            'total_hrd' => $data->where('peran', 'hrd')->count(),
            'total_karyawan_biasa' => $data->where('peran', 'karyawan')->count(),
        ];

        return response()->json([
            'success' => true,
            'data' => $data,
            'summary' => $summary
        ]);
    }

    private function laporanDepartemen($request)
    {
        $data = Departemen::withCount('karyawan')
            ->with(['karyawan' => function($q) {
                $q->withCount('cuti');
            }])
            ->get();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function export(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Fitur export akan dikembangkan'
        ]);
    }
}
