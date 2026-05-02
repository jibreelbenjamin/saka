<?php

namespace App\Http\Controllers;

use App\Models\SakaAdmin;
use App\Models\SakaGuru;
use App\Models\SakaSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'role' => 'required|in:admin,guru,siswa',
        ], [
            'username.required' => 'Username wajib diisi',
            'username.string' => 'Username wajib berisi string',
            'password.required' => 'Password wajib diisi',
            'password.string' => 'Password wajib berisi string',
            'role.required' => 'Role wajib dipilih',
            'role.in' => 'Role tidak tersedia',
        ]);

        $credentials = $request->only('username', 'password');
        $role = $request->role;

        $user = null;
        $guard = null;

        switch ($role) {
            case 'admin':
                $user = SakaAdmin::where('username', $credentials['username'])->first();
                if ($user && Hash::check($credentials['password'], $user->password)) {
                    $guard = 'admin';
                    Auth::guard('web')->loginUsingId($user->id_admin);
                }
                break;
            
            case 'guru':
                $user = SakaGuru::where('username', $credentials['username'])->first();
                if ($user && Hash::check($credentials['password'], $user->password)) {
                    $guard = 'guru';
                    Auth::guard('web')->loginUsingId($user->id_guru);
                }
                break;
            
            case 'siswa':
                $user = SakaSiswa::with('kelas')->where('username', $credentials['username'])->first();
                if ($user && Hash::check($credentials['password'], $user->password)) {
                    $guard = 'siswa';
                    Auth::guard('web')->loginUsingId($user->id_siswa);
                }
                break;
        }

        if ($user && $guard) {
            session(['role' => $role]);
            
            return redirect()->route('home')->with('successToast', 'Selamat datang!');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->withInput($request->only('username', 'role'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login')->with('successToast', 'Anda berhasil logout.');
    }
}