<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use Illuminate\Http\Request;

class PengajuanCutiController extends Controller
{
    public function index(Request $request)
    {
        $query = Cuti::with(['karyawan.departemen', 'jenisCuti']);

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $cutis = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('hrd.pengajuan-cuti.index', compact('cutis'));
    }

    public function show($id)
    {
        $cuti = Cuti::with(['karyawan.departemen', 'jenisCuti'])->findOrFail($id);
        return view('hrd.pengajuan-cuti.show', compact('cuti'));
    }
}
