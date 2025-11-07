<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function index()
    {
        /** @var \App\Models\Karyawan $karyawan */
        $karyawan = Auth::guard('karyawan')->user();
        
        $notifikasis = Notifikasi::where('id_karyawan', $karyawan->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('karyawan.notifikasi.index', compact('notifikasis'));
    }
    
    public function markAsRead()
    {
        /** @var \App\Models\Karyawan $karyawan */
        $karyawan = Auth::guard('karyawan')->user();
        
        Notifikasi::where('id_karyawan', $karyawan->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);
        
        return redirect()->back()->with('success', 'Semua notifikasi telah ditandai sebagai sudah dibaca');
    }
}
