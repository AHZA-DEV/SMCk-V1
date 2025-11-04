<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use Illuminate\Http\Request;

class DepartemenController extends Controller
{
    public function index()
    {
        $departemens = Departemen::withCount('karyawans')->paginate(10);
        return view('admin.kelola-departemen.index', compact('departemens'));
    }

    public function create()
    {
        return view('admin.kelola-departemen.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_departemen' => 'required|string|max:255|unique:departemens,nama_departemen',
            'kode_departemen' => 'required|string|max:50|unique:departemens,kode_departemen',
        ]);

        Departemen::create($validated);

        return redirect()->route('admin.departemen.index')
            ->with('success', 'Departemen berhasil ditambahkan');
    }

    public function show($id)
    {
        $departemen = Departemen::with('karyawans')->findOrFail($id);
        return view('admin.kelola-departemen.show', compact('departemen'));
    }

    public function edit($id)
    {
        $departemen = Departemen::findOrFail($id);
        return view('admin.kelola-departemen.edit', compact('departemen'));
    }

    public function update(Request $request, $id)
    {
        $departemen = Departemen::findOrFail($id);

        $validated = $request->validate([
            'nama_departemen' => 'required|string|max:255|unique:departemens,nama_departemen,' . $id,
            'kode_departemen' => 'required|string|max:50|unique:departemens,kode_departemen,' . $id,
        ]);

        $departemen->update($validated);

        return redirect()->route('admin.departemen.index')
            ->with('success', 'Departemen berhasil diupdate');
    }

    public function destroy($id)
    {
        $departemen = Departemen::findOrFail($id);
        
        if ($departemen->karyawans()->count() > 0) {
            return redirect()->route('admin.departemen.index')
                ->with('error', 'Departemen tidak dapat dihapus karena masih memiliki karyawan');
        }

        $departemen->delete();

        return redirect()->route('admin.departemen.index')
            ->with('success', 'Departemen berhasil dihapus');
    }
}
