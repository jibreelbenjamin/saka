<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRoleWeb
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('errorToast', 'Silakan login terlebih dahulu.');
        }

        $userRole = session('role');

        if (!$userRole) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login')->with('errorToast', 'Sesi kadaluarsa. Silakan login kembali.');
        }

        if (!in_array($userRole, $roles)) {
            return redirect()
                ->route('home')
                ->with('warningToast', 'Tidak memiliki akses');
        }

        return $next($request);
    }
}