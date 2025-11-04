<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class HrdController extends Controller
{
    public function index()
    {
        $hrds = Karyawan::where('peran', 'hrd')
            ->with('departemen')
            ->get();

        return view('admin.kelola-hrd.index', compact('hrds'));
    }

    public function show($id)
    {
        $hrd = Karyawan::where('peran', 'hrd')
            ->with('departemen')
            ->findOrFail($id);

        return view('admin.kelola-hrd.show', compact('hrd'));
    }
}