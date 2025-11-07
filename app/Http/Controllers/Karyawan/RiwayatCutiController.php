<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatCutiController extends Controller
{
    public function index()
    {
        $karyawan = Auth::guard('karyawan')->user();
        
        $cutis = Cuti::where('id_karyawan', $karyawan->id)
            ->with(['jenisCuti'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('karyawan.riwayat-cuti.index', compact('cutis'));
    }
    
    public function show($id)
    {
        $karyawan = Auth::guard('karyawan')->user();
        
        $cuti = Cuti::where('id_karyawan', $karyawan->id)
            ->with(['jenisCuti', 'disetujuiOleh'])
            ->findOrFail($id);
        
        return view('karyawan.riwayat-cuti.show', compact('cuti'));
    }
}
