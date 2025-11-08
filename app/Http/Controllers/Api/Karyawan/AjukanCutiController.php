<?php

namespace App\Http\Controllers\Api\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use App\Models\JenisCuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AjukanCutiController extends Controller
{
    public function index()
    {
        $jenisCuti = JenisCuti::all();
        
        return response()->json([
            'success' => true,
            'data' => $jenisCuti
        ]);
    }

    public function store(Request $request)
    {
        $karyawan = $request->user();

        $validator = Validator::make($request->all(), [
            'jenis_cuti_id' => 'required|exists:jenis_cutis,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $tanggalMulai = \Carbon\Carbon::parse($request->tanggal_mulai);
        $tanggalSelesai = \Carbon\Carbon::parse($request->tanggal_selesai);
        $jumlahHari = $tanggalMulai->diffInDays($tanggalSelesai) + 1;

        if ($jumlahHari > $karyawan->sisa_cuti) {
            return response()->json([
                'success' => false,
                'message' => 'Sisa cuti tidak mencukupi'
            ], 422);
        }

        $cuti = Cuti::create([
            'karyawan_id' => $karyawan->id,
            'jenis_cuti_id' => $request->jenis_cuti_id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'jumlah_hari' => $jumlahHari,
            'alasan' => $request->alasan,
            'status' => 'pending'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pengajuan cuti berhasil diajukan',
            'data' => $cuti->load('jenisCuti')
        ], 201);
    }
}
