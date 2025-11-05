<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\Departemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataKaryawanController extends Controller
{
    public function index(Request $request)
    {
        $query = Karyawan::with(['departemen', 'sisaCutiTahunan']);

        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('nip', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $karyawans = $query->paginate(10);

        return view('hrd.data-karyawan.index', compact('karyawans'));
    }

    public function show($id)
    {
        $karyawan = Karyawan::with(['departemen', 'cuti', 'sisaCutiTahunan'])->findOrFail($id);
        return view('hrd.data-karyawan.show', compact('karyawan'));
    }

    public function create()
    {
        $departemens = \App\Models\Departemen::all();
        return view('hrd.data-karyawan.create', compact('departemens'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip' => 'required|unique:karyawans,nip',
            'nama_depan' => 'required|string|max:255',
            'nama_belakang' => 'required|string|max:255',
            'email' => 'required|email|unique:karyawans,email',
            'password' => 'required|min:6|confirmed',
            'id_departemen' => 'required|exists:departemens,id',
            'jabatan' => 'required|string|max:255',
            'tanggal_mulai_kerja' => 'required|date',
            'no_telepon' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['peran'] = 'karyawan';

        Karyawan::create($validated);

        return redirect()->route('hrd.data-karyawan.index')
            ->with('success', 'Data karyawan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $departemens = \App\Models\Departemen::all();
        return view('hrd.data-karyawan.edit', compact('karyawan', 'departemens'));
    }

    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $validated = $request->validate([
            'nip' => 'required|unique:karyawans,nip,' . $id,
            'nama_depan' => 'required|string|max:255',
            'nama_belakang' => 'required|string|max:255',
            'email' => 'required|email|unique:karyawans,email,' . $id,
            'id_departemen' => 'required|exists:departemens,id',
            'jabatan' => 'required|string|max:255',
            'tanggal_mulai_kerja' => 'required|date',
            'no_telepon' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
        ]);

        $karyawan->update($validated);

        return redirect()->route('hrd.data-karyawan.index')
            ->with('success', 'Data karyawan berhasil diupdate');
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();

        return redirect()->route('hrd.data-karyawan.index')
            ->with('success', 'Data karyawan berhasil dihapus');
    }
}