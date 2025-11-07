<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use App\Models\JenisCuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AjukanCutiController extends Controller
{
    public function index()
    {
        $jenisCutis = JenisCuti::all();
        $karyawan = Auth::guard('karyawan')->user();
        
        return view('karyawan.ajukan-cuti.index', compact('jenisCutis', 'karyawan'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_cuti_id' => 'required|exists:jenis_cutis,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|string',
            'lampiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048'
        ]);
        
        $karyawan = Auth::guard('karyawan')->user();
        
        // Calculate duration
        $tanggalMulai = Carbon::parse($validated['tanggal_mulai']);
        $tanggalSelesai = Carbon::parse($validated['tanggal_selesai']);
        
        // Check if tanggal_mulai is at least today
        if ($tanggalMulai->lt(Carbon::today())) {
            return redirect()->back()
                ->with('error', 'Tanggal mulai cuti tidak boleh kurang dari hari ini')
                ->withInput();
        }
        
        $durasi = $tanggalMulai->diffInDays($tanggalSelesai) + 1;
        
        // Check if enough cuti available
        $jenisCuti = JenisCuti::find($validated['jenis_cuti_id']);
        if ($jenisCuti->nama_cuti == 'Cuti Tahunan' && $durasi > $karyawan->sisa_cuti) {
            return redirect()->back()
                ->with('error', 'Sisa cuti Anda tidak mencukupi. Sisa cuti: ' . $karyawan->sisa_cuti . ' hari')
                ->withInput();
        }
        
        // Handle file upload
        $lampiranPath = null;
        if ($request->hasFile('lampiran')) {
            $lampiranPath = $request->file('lampiran')->store('lampiran-cuti', 'public');
        }
        
        Cuti::create([
            'id_karyawan' => $karyawan->id,
            'id_jenis_cuti' => $validated['jenis_cuti_id'],
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'tanggal_selesai' => $validated['tanggal_selesai'],
            'jumlah_hari' => $durasi,
            'alasan' => $validated['alasan'],
            'lampiran' => $lampiranPath,
            'status' => 'menunggu'
        ]);
        
        return redirect()->route('karyawan.ajukan-cuti.index')
            ->with('success', 'Pengajuan cuti berhasil diajukan dan menunggu persetujuan HRD');
    }
}
