<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisCuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JenisCutiController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $jenisCutis = JenisCuti::paginate($perPage);
        
        return response()->json([
            'success' => true,
            'data' => $jenisCutis
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_cuti' => 'required|string|max:255',
            'jumlah_hari' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $jenisCuti = JenisCuti::create($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Jenis cuti berhasil ditambahkan',
            'data' => $jenisCuti
        ], 201);
    }

    public function show($id)
    {
        $jenisCuti = JenisCuti::find($id);

        if (!$jenisCuti) {
            return response()->json([
                'success' => false,
                'message' => 'Jenis cuti tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $jenisCuti
        ]);
    }

    public function update(Request $request, $id)
    {
        $jenisCuti = JenisCuti::find($id);

        if (!$jenisCuti) {
            return response()->json([
                'success' => false,
                'message' => 'Jenis cuti tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_cuti' => 'required|string|max:255',
            'jumlah_hari' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $jenisCuti->update($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Jenis cuti berhasil diupdate',
            'data' => $jenisCuti
        ]);
    }

    public function destroy($id)
    {
        $jenisCuti = JenisCuti::find($id);

        if (!$jenisCuti) {
            return response()->json([
                'success' => false,
                'message' => 'Jenis cuti tidak ditemukan'
            ], 404);
        }

        $jenisCuti->delete();

        return response()->json([
            'success' => true,
            'message' => 'Jenis cuti berhasil dihapus'
        ]);
    }
}
