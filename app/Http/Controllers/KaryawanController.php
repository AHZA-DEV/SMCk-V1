<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Departemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawans = Karyawan::with('departemen')->paginate(10);
        return view('admin.kelola-karyawan.index', compact('karyawans'));
    }

    public function create()
    {
        $departemens = Departemen::all();
        return view('admin.kelola-karyawan.create', compact('departemens'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip' => 'required|unique:karyawans,nip',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:karyawans,email',
            'password' => 'required|min:6',
            'id_departemen' => 'required|exists:departemens,id',
            'jabatan' => 'required|string|max:255',
            'tanggal_mulai_kerja' => 'required|date',
            'peran' => 'required|in:karyawan,hrd',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        Karyawan::create($validated);

        return redirect()->route('admin.karyawan.index')
            ->with('success', 'Karyawan berhasil ditambahkan');
    }

    public function show($id)
    {
        $karyawan = Karyawan::with('departemen')->findOrFail($id);
        return view('admin.kelola-karyawan.show', compact('karyawan'));
    }

    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $departemens = Departemen::all();
        return view('admin.kelola-karyawan.edit', compact('karyawan', 'departemens'));
    }

    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $validated = $request->validate([
            'nip' => 'required|unique:karyawans,nip,' . $id,
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:karyawans,email,' . $id,
            'id_departemen' => 'required|exists:departemens,id',
            'jabatan' => 'required|string|max:255',
            'tanggal_mulai_kerja' => 'required|date',
            'peran' => 'required|in:karyawan,hrd',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        }

        $karyawan->update($validated);

        return redirect()->route('admin.karyawan.index')
            ->with('success', 'Karyawan berhasil diupdate');
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();

        return redirect()->route('admin.karyawan.index')
            ->with('success', 'Karyawan berhasil dihapus');
    }
}
