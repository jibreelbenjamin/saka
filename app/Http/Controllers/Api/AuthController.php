<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SakaAdmin;
use App\Models\SakaGuru;
use App\Models\SakaSiswa;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    use ApiResponseTrait;

    public function login(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required|string',
                'password' => 'required|string',
                'role' => 'required|in:admin,guru,siswa',
            ]);

            $user = null;
            $profile = null;
            $role = $request->role;

            switch ($role) {
                case 'admin':
                    $user = SakaAdmin::where('username', $request->username)->first();
                    if ($user) {
                        $profile = [
                            'id_admin' => $user->id_admin,
                            'nama_admin' => $user->nama_admin,
                        ];
                    }
                    break;
                
                case 'guru':
                    $user = SakaGuru::where('username', $request->username)->first();
                    if ($user) {
                        $profile = [
                            'id_guru' => $user->id_guru,
                            'nama_guru' => $user->nama_guru,
                        ];
                    }
                    break;
                
                case 'siswa':
                    $user = SakaSiswa::with('kelas')->where('username', $request->username)->first();
                    if ($user) {
                        $profile = [
                            'id_siswa' => $user->id_siswa,
                            'id_kelas' => $user->id_kelas,
                            'nama_lengkap' => $user->nama_lengkap,
                            'kelas' => $user->kelas ? $user->kelas->nama_kelas : null,
                            'tingkat' => $user->kelas ? $user->kelas->tingkat : null,
                            'kontak' => $user->kontak,
                            'alamat' => $user->alamat,
                        ];
                    }
                    break;
            }

            if (!$user) {
                return $this->errorResponse(
                    'Username tidak ditemukan',
                    404,
                    ['username' => ['Username ' . $request->username . ' tidak terdaftar sebagai ' . $role]]
                );
            }

            if (!Hash::check($request->password, $user->password)) {
                return $this->errorResponse(
                    'Password salah',
                    401,
                    ['password' => ['Password yang Anda masukkan salah']]
                );
            }

            $user->tokens()->delete();

            $token = $user->createToken('auth_token_' . $role)->plainTextToken;

            $data = [
                'user' => [
                    'username' => $user->username,
                    'role' => $role,
                ],
                'profile' => $profile,
                'access_token' => $token,
                'token_expiration' => '7 Days',
                'token_type' => 'Bearer',
            ];

            return $this->successResponse(
                $data,
                'Login berhasil sebagai ' . $role,
                200
            );

        } catch (ValidationException $e) {
            return $this->validationErrorResponse($e->errors(), 'Validasi gagal', 422);
        } catch (\Exception $e) {
            return $this->errorResponse(
                'Terjadi kesalahan pada server',
                500,
                app()->environment('local') ? [$e->getMessage()] : null
            );
        }
    }

    public function logout(Request $request)
    {
        try {
            $user = $request->user();
            
            if ($user) {
                $user->currentAccessToken()->delete();
            }

            return $this->successResponse(
                null,
                'Logout berhasil',
                200
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                'Terjadi kesalahan saat logout',
                500,
                app()->environment('local') ? [$e->getMessage()] : null
            );
        }
    }

    public function me(Request $request)
    {
        try {
            $user = $request->user();
            $role = null;
            $profile = null;

            if ($user instanceof SakaAdmin) {
                $role = 'admin';
                $profile = [
                    'id_admin' => $user->id_admin,
                    'nama_admin' => $user->nama_admin,
                ];
            } elseif ($user instanceof SakaGuru) {
                $role = 'guru';
                $profile = [
                    'id_guru' => $user->id_guru,
                    'nama_guru' => $user->nama_guru,
                ];
            } elseif ($user instanceof SakaSiswa) {
                $role = 'siswa';
                $user->load('kelas');
                $profile = [
                    'id_siswa' => $user->id_siswa,
                    'id_kelas' => $user->id_kelas,
                    'nama_lengkap' => $user->nama_lengkap,
                    'kelas' => $user->kelas ? $user->kelas->nama_kelas : null,
                    'tingkat' => $user->kelas ? $user->kelas->tingkat : null,
                    'kontak' => $user->kontak,
                    'alamat' => $user->alamat,
                ];
            }

            $data = [
                'user' => [
                    'username' => $user->username,
                    'role' => $role,
                ],
                'profile' => $profile,
            ];

            return $this->successResponse(
                $data,
                'Data user ditemukan',
                200
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                'Terjadi kesalahan',
                500,
                app()->environment('local') ? [$e->getMessage()] : null
            );
        }
    }
}