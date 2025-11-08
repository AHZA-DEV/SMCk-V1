<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Cuti;
use App\Models\Departemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $totalKaryawan = Karyawan::count();
        $totalDepartemen = Departemen::count();
        $cutiPending = Cuti::where('status', 'pending')->count();
        $cutiDisetujui = Cuti::where('status', 'disetujui')
            ->whereYear('tanggal_mulai', date('Y'))
            ->count();
        $cutiDitolak = Cuti::where('status', 'ditolak')->count();
        
        $cutiTerbaru = Cuti::with(['karyawan', 'jenisCuti'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalKaryawan',
            'totalDepartemen',
            'cutiPending',
            'cutiDisetujui',
            'cutiDitolak',
            'cutiTerbaru'
        ));
    }
}
