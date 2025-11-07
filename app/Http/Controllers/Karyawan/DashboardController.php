<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $karyawan = Auth::guard('karyawan')->user();
        
        // Get statistics
        $sisaCuti = $karyawan->sisa_cuti;
        $cutiTerpakai = 12 - $sisaCuti;
        $pengajuanPending = Cuti::where('id_karyawan', $karyawan->id)
            ->where('status', 'menunggu')
            ->count();
        $cutiDisetujui = Cuti::where('id_karyawan', $karyawan->id)
            ->where('status', 'disetujui')
            ->count();
        
        // Get recent cuti
        $riwayatCuti = Cuti::with('jenisCuti')
            ->where('id_karyawan', $karyawan->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('karyawan.dashboard', compact(
            'sisaCuti',
            'cutiTerpakai',
            'pengajuanPending',
            'cutiDisetujui',
            'riwayatCuti'
        ));
    }
}
