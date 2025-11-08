<?php

namespace App\Http\Controllers\Api\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index(Request $request)
    {
        $karyawan = $request->user();
        
        $notifikasi = Notifikasi::where('karyawan_id', $karyawan->id)
            ->latest()
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $notifikasi
        ]);
    }

    public function markAsRead(Request $request, $id)
    {
        $karyawan = $request->user();
        
        $notifikasi = Notifikasi::where('karyawan_id', $karyawan->id)
            ->find($id);

        if (!$notifikasi) {
            return response()->json([
                'success' => false,
                'message' => 'Notifikasi tidak ditemukan'
            ], 404);
        }

        $notifikasi->update(['dibaca' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Notifikasi berhasil ditandai sebagai dibaca'
        ]);
    }

    public function markAllAsRead(Request $request)
    {
        $karyawan = $request->user();
        
        Notifikasi::where('karyawan_id', $karyawan->id)
            ->where('dibaca', false)
            ->update(['dibaca' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Semua notifikasi berhasil ditandai sebagai dibaca'
        ]);
    }

    public function unreadCount(Request $request)
    {
        $karyawan = $request->user();
        
        $count = Notifikasi::where('karyawan_id', $karyawan->id)
            ->where('dibaca', false)
            ->count();

        return response()->json([
            'success' => true,
            'data' => [
                'unread_count' => $count
            ]
        ]);
    }
}
