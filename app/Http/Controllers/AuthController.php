<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Karyawan;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Cek apakah user adalah admin (dari users table)
        $admin = User::where('email', $request->email)->first();
        
        if ($admin && Hash::check($request->password, $admin->password)) {
            Auth::guard('web')->login($admin);
            $request->session()->regenerate();
            
            return redirect()->route('admin.dashboard')->with('success', 'Login berhasil sebagai Admin');
        }

        // Cek apakah user adalah karyawan/hrd (dari karyawans table)
        $karyawan = Karyawan::where('email', $request->email)->first();
        
        if ($karyawan && Hash::check($request->password, $karyawan->password)) {
            Auth::guard('karyawan')->login($karyawan);
            $request->session()->regenerate();
            
            // Redirect berdasarkan role
            if ($karyawan->peran === 'hrd') {
                return redirect()->route('hrd.dashboard')->with('success', 'Login berhasil sebagai HRD');
            } else {
                return redirect()->route('karyawan.dashboard')->with('success', 'Login berhasil sebagai Karyawan');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // Logout
    public function logout(Request $request)
    {
        // Check which guard is authenticated and logout
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        } elseif (Auth::guard('karyawan')->check()) {
            Auth::guard('karyawan')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logout berhasil');
    }

    // Get authenticated user info
    public function user()
    {
        if (Auth::guard('web')->check()) {
            return [
                'user' => Auth::guard('web')->user(),
                'role' => 'admin',
                'guard' => 'web'
            ];
        } elseif (Auth::guard('karyawan')->check()) {
            $karyawan = Auth::guard('karyawan')->user();
            return [
                'user' => $karyawan,
                'role' => $karyawan->peran,
                'guard' => 'karyawan'
            ];
        }
        
        return null;
    }
}
