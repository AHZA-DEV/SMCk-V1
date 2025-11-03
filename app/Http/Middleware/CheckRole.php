<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Check admin (web guard)
        if (Auth::guard('web')->check() && in_array('admin', $roles)) {
            return $next($request);
        }

        // Check karyawan/hrd (karyawan guard)
        if (Auth::guard('karyawan')->check()) {
            $user = Auth::guard('karyawan')->user();
            if (in_array($user->peran, $roles)) {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized access');
    }
}
