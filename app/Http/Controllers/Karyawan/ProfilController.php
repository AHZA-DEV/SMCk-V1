<?php

namespace App\Http\Controllers\Karyawan;

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
        /** @var Karyawan $karyawan */
        $karyawan = Auth::guard('karyawan')->user();
        
        return view('karyawan.profil.index', compact('karyawan'));
    }
    
    public function update(Request $request)
    {
        /** @var Karyawan $karyawan */
        $karyawan = Auth::guard('karyawan')->user();
        
        $validated = $request->validate([
            'nama_depan' => 'required|string|max:255',
            'nama_belakang' => 'required|string|max:255',
            'email' => 'required|email|unique:karyawans,email,' . $karyawan->id,
            'no_telepon' => 'nullable|string|max:20',
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
        
        return redirect()->route('karyawan.profil.index')
            ->with('success', 'Profil berhasil diperbarui');
    }
    
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:6|confirmed'
        ]);
        
        /** @var Karyawan $karyawan */
        $karyawan = Auth::guard('karyawan')->user();
        
        if (!Hash::check($validated['password_lama'], $karyawan->password)) {
            return redirect()->back()
                ->with('error', 'Password lama tidak sesuai');
        }
        
        $karyawan->update([
            'password' => Hash::make($validated['password_baru'])
        ]);
        
        return redirect()->route('karyawan.profil.index')
            ->with('success', 'Password berhasil diperbarui');
    }
}
