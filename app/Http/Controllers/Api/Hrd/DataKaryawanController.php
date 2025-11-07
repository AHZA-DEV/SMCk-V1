<?php

namespace App\Http\Controllers\Api\Hrd;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class DataKaryawanController extends Controller
{
    public function index(Request $request)
    {
        $query = Karyawan::with('departemen')
            ->where('peran', 'karyawan');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->has('departemen_id') && $request->departemen_id != '') {
            $query->where('departemen_id', $request->departemen_id);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $karyawan = $query->latest()->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $karyawan
        ]);
    }

    public function show($id)
    {
        $karyawan = Karyawan::with(['departemen', 'cutis.jenisCuti'])->find($id);

        if (!$karyawan) {
            return response()->json([
                'success' => false,
                'message' => 'Karyawan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $karyawan
        ]);
    }
}
