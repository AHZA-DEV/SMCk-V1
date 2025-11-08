<?php

namespace App\Http\Controllers\Api\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function index(Request $request)
    {
        $karyawan = $request->user();
        
        return response()->json([
            'success' => true,
            'data' => $karyawan->load('departemen')
        ]);
    }

    public function update(Request $request)
    {
        $karyawan = $request->user();

        $validator = Validator::make($request->all(), [
            'nama_depan' => 'required|string|max:50',
            'nama_belakang' => 'required|string|max:50',
            'email' => 'required|email|unique:karyawans,email,' . $karyawan->id,
            'no_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'foto_profil' => 'nullable|image|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->only(['nama_depan', 'nama_belakang', 'email', 'no_telepon', 'alamat']);

        if ($request->hasFile('foto_profil')) {
            if ($karyawan->foto_profil && $karyawan->foto_profil !== 'default.png') {
                Storage::delete('public/foto_profil/' . $karyawan->foto_profil);
            }

            $file = $request->file('foto_profil');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/foto_profil', $filename);
            $data['foto_profil'] = $filename;
        }

        $karyawan->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diupdate',
            'data' => $karyawan->load('departemen')
        ]);
    }

    public function updatePassword(Request $request)
    {
        $karyawan = $request->user();

        $validator = Validator::make($request->all(), [
            'password_lama' => 'required',
            'password_baru' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        if (!Hash::check($request->password_lama, $karyawan->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Password lama tidak sesuai'
            ], 422);
        }

        $karyawan->update([
            'password' => Hash::make($request->password_baru)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Password berhasil diupdate'
        ]);
    }
}
