<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function index()
    {
        $karyawan = Auth::guard('karyawan')->user();
        return view('hrd.profil.index', compact('karyawan'));
    }

    public function update(Request $request)
    {
        $user = Auth::guard('karyawan')->user();
        $karyawan = Karyawan::findOrFail($user->id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:karyawans,email,' . $karyawan->id,
            'no_telepon' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
            'foto_profil' => 'nullable|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        // Handle foto profil upload
        if ($request->hasFile('foto_profil')) {
            // Delete old photo if exists
            if ($karyawan->foto_profil) {
                Storage::disk('public')->delete($karyawan->foto_profil);
            }
            
            $path = $request->file('foto_profil')->store('foto_profil', 'public');
            $validated['foto_profil'] = $path;
        }

        $karyawan->update($validated);

        return redirect()->route('hrd.profil.index')
            ->with('success', 'Profil berhasil diupdate');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::guard('karyawan')->user();
        $karyawan = Karyawan::findOrFail($user->id);

        if (!Hash::check($request->current_password, $karyawan->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai']);
        }

        $karyawan->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('hrd.profil.index')
            ->with('success', 'Password berhasil diupdate');
    }
}
