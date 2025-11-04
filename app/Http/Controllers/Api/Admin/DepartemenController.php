<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartemenController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $departemens = Departemen::withCount('karyawans')->paginate($perPage);
        
        return response()->json([
            'success' => true,
            'data' => $departemens
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_departemen' => 'required|string|max:255|unique:departemens,nama_departemen',
            'kode_departemen' => 'required|string|max:50|unique:departemens,kode_departemen',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $departemen = Departemen::create($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Departemen berhasil ditambahkan',
            'data' => $departemen
        ], 201);
    }

    public function show($id)
    {
        $departemen = Departemen::withCount('karyawans')->find($id);

        if (!$departemen) {
            return response()->json([
                'success' => false,
                'message' => 'Departemen tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $departemen
        ]);
    }

    public function update(Request $request, $id)
    {
        $departemen = Departemen::find($id);

        if (!$departemen) {
            return response()->json([
                'success' => false,
                'message' => 'Departemen tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_departemen' => 'required|string|max:255|unique:departemens,nama_departemen,' . $id,
            'kode_departemen' => 'required|string|max:50|unique:departemens,kode_departemen,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $departemen->update($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Departemen berhasil diupdate',
            'data' => $departemen
        ]);
    }

    public function destroy($id)
    {
        $departemen = Departemen::find($id);

        if (!$departemen) {
            return response()->json([
                'success' => false,
                'message' => 'Departemen tidak ditemukan'
            ], 404);
        }

        if ($departemen->karyawans()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Departemen tidak dapat dihapus karena masih memiliki karyawan'
            ], 400);
        }

        $departemen->delete();

        return response()->json([
            'success' => true,
            'message' => 'Departemen berhasil dihapus'
        ]);
    }
}
