<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Karyawan;
use App\Models\JenisCuti;
use Illuminate\Http\Request;

class CutiController extends Controller
{
    public function index()
    {
        $cutis = Cuti::with(['karyawan', 'jenisCuti'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.kelola-cuti.index', compact('cutis'));
    }

    public function show($id)
    {
        $cuti = Cuti::with(['karyawan.departemen', 'jenisCuti'])->findOrFail($id);
        return view('admin.kelola-cuti.show', compact('cuti'));
    }

    public function updateStatus(Request $request, $id)
    {
        $cuti = Cuti::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,disetujui,ditolak',
            'catatan_approver' => 'nullable|string',
        ]);

        $cuti->update([
            'status' => $validated['status'],
            'catatan_approver' => $validated['catatan_approver'] ?? null,
            'tanggal_approve' => $validated['status'] != 'pending' ? now() : null,
        ]);

        return redirect()->route('admin.cuti.index')
            ->with('success', 'Status cuti berhasil diupdate');
    }

    public function destroy($id)
    {
        $cuti = Cuti::findOrFail($id);
        $cuti->delete();

        return redirect()->route('admin.cuti.index')
            ->with('success', 'Data cuti berhasil dihapus');
    }
}
