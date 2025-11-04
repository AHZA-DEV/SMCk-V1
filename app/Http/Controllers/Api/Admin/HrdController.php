<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HrdController extends Controller
{
    public function index()
    {
        $hrd = Karyawan::where('peran', 'hrd')
            ->with('departemen')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $hrd
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nip' => 'required|unique:karyawans,nip',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:karyawans,email',
            'password' => 'required|min:6',
            'departemen_id' => 'required|exists:departemens,id',
            'tanggal_bergabung' => 'required|date',
            'jatah_cuti_tahunan' => 'required|integer|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $hrd = Karyawan::create([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'departemen_id' => $request->departemen_id,
            'peran' => 'hrd',
            'tanggal_bergabung' => $request->tanggal_bergabung,
            'jatah_cuti_tahunan' => $request->jatah_cuti_tahunan
        ]);

        return response()->json([
            'success' => true,
            'message' => 'HRD berhasil ditambahkan',
            'data' => $hrd->load('departemen')
        ], 201);
    }

    public function show($id)
    {
        $hrd = Karyawan::where('peran', 'hrd')
            ->with('departemen')
            ->find($id);

        if (!$hrd) {
            return response()->json([
                'success' => false,
                'message' => 'HRD tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $hrd
        ]);
    }

    public function update(Request $request, $id)
    {
        $hrd = Karyawan::where('peran', 'hrd')->find($id);

        if (!$hrd) {
            return response()->json([
                'success' => false,
                'message' => 'HRD tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nip' => 'required|unique:karyawans,nip,' . $id,
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:karyawans,email,' . $id,
            'departemen_id' => 'required|exists:departemens,id',
            'tanggal_bergabung' => 'required|date',
            'jatah_cuti_tahunan' => 'required|integer|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $hrd->update([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'email' => $request->email,
            'departemen_id' => $request->departemen_id,
            'tanggal_bergabung' => $request->tanggal_bergabung,
            'jatah_cuti_tahunan' => $request->jatah_cuti_tahunan
        ]);

        if ($request->filled('password')) {
            $hrd->update(['password' => Hash::make($request->password)]);
        }

        return response()->json([
            'success' => true,
            'message' => 'HRD berhasil diupdate',
            'data' => $hrd->load('departemen')
        ]);
    }

    public function destroy($id)
    {
        $hrd = Karyawan::where('peran', 'hrd')->find($id);

        if (!$hrd) {
            return response()->json([
                'success' => false,
                'message' => 'HRD tidak ditemukan'
            ], 404);
        }

        $hrd->delete();

        return response()->json([
            'success' => true,
            'message' => 'HRD berhasil dihapus'
        ]);
    }
}
