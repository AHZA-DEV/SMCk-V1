<?php

namespace App\Http\Controllers\Api\Hrd;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApprovalCutiController extends Controller
{
    public function index(Request $request)
    {
        $query = Cuti::with(['karyawan.departemen', 'jenisCuti'])
            ->where('status', 'pending');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('karyawan', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%");
            });
        }

        if ($request->has('departemen_id') && $request->departemen_id != '') {
            $query->whereHas('karyawan', function ($q) use ($request) {
                $q->where('departemen_id', $request->departemen_id);
            });
        }

        $pengajuan = $query->latest()->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $pengajuan
        ]);
    }

    public function show($id)
    {
        $cuti = Cuti::with(['karyawan.departemen', 'jenisCuti'])->find($id);

        if (!$cuti) {
            return response()->json([
                'success' => false,
                'message' => 'Pengajuan cuti tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $cuti
        ]);
    }

    public function approve(Request $request, $id)
    {
        $cuti = Cuti::find($id);

        if (!$cuti) {
            return response()->json([
                'success' => false,
                'message' => 'Pengajuan cuti tidak ditemukan'
            ], 404);
        }

        if ($cuti->status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'Pengajuan cuti sudah diproses sebelumnya'
            ], 400);
        }

        $validator = Validator::make($request->all(), [
            'catatan' => 'nullable|string|max:500'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $cuti->update([
            'status' => 'disetujui',
            'disetujui_oleh' => auth()->guard('sanctum')->id(),
            'tanggal_approve' => now(),
            'catatan_approval' => $request->catatan
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pengajuan cuti berhasil disetujui',
            'data' => $cuti->load(['karyawan', 'jenisCuti', 'disetujuiOleh'])
        ]);
    }

    public function reject(Request $request, $id)
    {
        $cuti = Cuti::find($id);

        if (!$cuti) {
            return response()->json([
                'success' => false,
                'message' => 'Pengajuan cuti tidak ditemukan'
            ], 404);
        }

        if ($cuti->status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'Pengajuan cuti sudah diproses sebelumnya'
            ], 400);
        }

        $validator = Validator::make($request->all(), [
            'alasan_penolakan' => 'required|string|max:500'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $cuti->update([
            'status' => 'ditolak',
            'disetujui_oleh' => auth()->guard('sanctum')->id(),
            'tanggal_approve' => now(),
            'catatan_approval' => $request->alasan_penolakan
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pengajuan cuti berhasil ditolak',
            'data' => $cuti->load(['karyawan', 'jenisCuti', 'disetujuiOleh'])
        ]);
    }
}
