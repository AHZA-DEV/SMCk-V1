<?php

namespace App\Http\Controllers;

use App\Models\JenisCuti;
use Illuminate\Http\Request;

class JenisCutiController extends Controller
{
    public function index()
    {
        $jenisCutis = JenisCuti::paginate(10);
        return view('admin.jenis-cuti.index', compact('jenisCutis'));
    }

    public function create()
    {
        return view('admin.jenis-cuti.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_cuti' => 'required|string|max:255',
            'jumlah_hari' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        JenisCuti::create($validated);

        return redirect()->route('admin.jenis-cuti.index')
            ->with('success', 'Jenis cuti berhasil ditambahkan');
    }

    public function show($id)
    {
        $jenisCuti = JenisCuti::withCount('cutis')->findOrFail($id);
        return view('admin.jenis-cuti.show', compact('jenisCuti'));
    }

    public function edit($id)
    {
        $jenisCuti = JenisCuti::findOrFail($id);
        return view('admin.jenis-cuti.edit', compact('jenisCuti'));
    }

    public function update(Request $request, $id)
    {
        $jenisCuti = JenisCuti::findOrFail($id);

        $validated = $request->validate([
            'nama_cuti' => 'required|string|max:255',
            'jumlah_hari' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        $jenisCuti->update($validated);

        return redirect()->route('admin.jenis-cuti.index')
            ->with('success', 'Jenis cuti berhasil diupdate');
    }

    public function destroy($id)
    {
        $jenisCuti = JenisCuti::findOrFail($id);
        $jenisCuti->delete();

        return redirect()->route('admin.jenis-cuti.index')
            ->with('success', 'Jenis cuti berhasil dihapus');
    }
}
