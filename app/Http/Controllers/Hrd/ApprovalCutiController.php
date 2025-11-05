<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApprovalCutiController extends Controller
{
    public function index(Request $request)
    {
        $query = Cuti::with(['karyawan.departemen', 'jenisCuti']);

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $cutis = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('hrd.approval-cuti.index', compact('cutis'));
    }

    public function show($id)
    {
        $cuti = Cuti::with(['karyawan.departemen', 'jenisCuti'])->findOrFail($id);
        return view('hrd.approval-cuti.show', compact('cuti'));
    }

    public function approve(Request $request, $id)
    {
        $cuti = Cuti::findOrFail($id);

        $request->validate([
            'catatan_approver' => 'nullable|string|max:500',
        ]);

        $cuti->update([
            'status' => 'disetujui',
            'catatan_approver' => $request->catatan_approver,
            'tanggal_approve' => now(),
            'disetujui_oleh' => Auth::guard('karyawan')->user()->nama,
        ]);

        return redirect()->route('hrd.approval-cuti.index')
            ->with('success', 'Cuti berhasil disetujui');
    }

    public function reject(Request $request, $id)
    {
        $cuti = Cuti::findOrFail($id);

        $request->validate([
            'catatan_approver' => 'required|string|max:500',
        ]);

        $cuti->update([
            'status' => 'ditolak',
            'catatan_approver' => $request->catatan_approver,
            'tanggal_approve' => now(),
            'disetujui_oleh' => Auth::guard('karyawan')->user()->nama,
        ]);

        return redirect()->route('hrd.approval-cuti.index')
            ->with('success', 'Cuti berhasil ditolak');
    }
}
