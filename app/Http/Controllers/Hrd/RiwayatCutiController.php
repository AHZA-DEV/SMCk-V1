<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use Illuminate\Http\Request;

class RiwayatCutiController extends Controller
{
    public function index(Request $request)
    {
        $query = Cuti::with(['karyawan.departemen', 'jenisCuti'])
            ->whereIn('status', ['disetujui', 'ditolak']);

        if ($request->has('search') && $request->search != '') {
            $query->whereHas('karyawan', function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%');
            });
        }

        $cutis = $query->orderBy('tanggal_approve', 'desc')->paginate(10);

        return view('hrd.riwayat-cuti.index', compact('cutis'));
    }

    public function show($id)
    {
        $cuti = Cuti::with(['karyawan.departemen', 'jenisCuti'])->findOrFail($id);
        return view('hrd.riwayat-cuti.show', compact('cuti'));
    }
}
