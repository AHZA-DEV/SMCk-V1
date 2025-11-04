<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CutiController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $cutis = Cuti::with(['karyawan', 'jenisCuti'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
        
        return response()->json([
            'success' => true,
            'data' => $cutis
        ]);
    }

    public function show($id)
    {
        $cuti = Cuti::with(['karyawan.departemen', 'jenisCuti'])->find($id);

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

    public function updateStatus(Request $request, $id)
    {
        $cuti = Cuti::find($id);

        if (!$cuti) {
            return response()->json([
                'success' => false,
                'message' => 'Data cuti tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,disetujui,ditolak',
            'catatan_approver' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $validated = $validator->validated();

        $cuti->update([
            'status' => $validated['status'],
            'catatan_approver' => $validated['catatan_approver'] ?? null,
            'tanggal_approve' => $validated['status'] != 'pending' ? now() : null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status cuti berhasil diupdate',
            'data' => $cuti->load(['karyawan', 'jenisCuti'])
        ]);
    }

    public function destroy($id)
    {
        $cuti = Cuti::find($id);

        if (!$cuti) {
            return response()->json([
                'success' => false,
                'message' => 'Data cuti tidak ditemukan'
            ], 404);
        }

        $cuti->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data cuti berhasil dihapus'
        ]);
    }
}
