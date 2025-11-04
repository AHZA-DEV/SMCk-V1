<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengaturanSistem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengaturanSistemController extends Controller
{
    public function index()
    {
        $pengaturan = PengaturanSistem::first();
        
        if (!$pengaturan) {
            $pengaturan = PengaturanSistem::create([
                'nama_aplikasi' => 'Sistem Manajemen Cuti',
                'jumlah_cuti_tahunan' => 12,
                'email_notifikasi' => 'admin@example.com',
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $pengaturan
        ]);
    }

    public function update(Request $request)
    {
        $pengaturan = PengaturanSistem::first();

        $validator = Validator::make($request->all(), [
            'nama_aplikasi' => 'required|string|max:255',
            'jumlah_cuti_tahunan' => 'required|integer|min:1',
            'email_notifikasi' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $pengaturan->update($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Pengaturan sistem berhasil diupdate',
            'data' => $pengaturan
        ]);
    }
}
