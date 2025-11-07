<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SisaCutiController extends Controller
{
    public function index()
    {
        $karyawan = Auth::guard('karyawan')->user();
        
        return view('karyawan.sisa-cuti.index', compact('karyawan'));
    }
}
