<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();
        
        if (!$user) {
            return response()->json([
                'status' => false,
                'code' => 401,
                'message' => 'Unauthorized. Token tidak ditemukan atau expired.',
                'meta' => [
                    'timestamp' => now()->toISOString(),
                    'path' => $request->path(),
                ]
            ], 401);
        }

        $userRole = $this->detectRole($user);
        
        if (!in_array($userRole, $roles)) {
            return response()->json([
                'status' => false,
                'code' => 403,
                'message' => 'Forbidden. Anda tidak memiliki akses ke resource ini.',
                'errors' => [
                    'role' => ['Role ' . $userRole . ' tidak diizinkan mengakses endpoint ini. Diperlukan role: ' . implode(', ', $roles)]
                ],
                'meta' => [
                    'timestamp' => now()->toISOString(),
                    'path' => $request->path(),
                ]
            ], 403);
        }

        $request->merge([
            'user_role' => $userRole,
            'user_model' => $user
        ]);
        
        return $next($request);
    }

    private function detectRole($user): string
    {
        if ($user instanceof \App\Models\SakaAdmin) {
            return 'admin';
        } elseif ($user instanceof \App\Models\SakaGuru) {
            return 'guru';
        } elseif ($user instanceof \App\Models\SakaSiswa) {
            return 'siswa';
        }
        
        return 'unknown';
    }
}