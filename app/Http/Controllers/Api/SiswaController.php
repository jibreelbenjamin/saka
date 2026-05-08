<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

use App\Models\SakaSiswa;

class SiswaController
{
    use ApiResponseTrait;

    protected $model = SakaSiswa::class;
    protected $table_primary = 'id_siswa';
    protected $data_title = 'siswa';

    protected $rules = [
        'id_kelas' => 'required|exists:saka_kelas,id_kelas',
        'username' => 'required|string|max:255|unique:saka_siswa,username',
        'password' => 'required|string|min:8|confirmed',
        'nama' => 'required|string|max:255',
        'kontak' => 'nullable|string|max:255',
        'alamat' => 'nullable|string|max:255',
    ];
    protected $messages = [
        'id_kelas.required' => 'Kelas siswa wajib dipilih',
        'id_kelas.exists' => 'Kelas siswa tidak valid',

        'username.required' => 'Username siswa wajib diisi',
        'username.string' => 'Username siswa harus berupa teks',
        'username.max' => 'Username siswa maksimal 255 karakter',
        'username.unique' => 'Username siswa sudah digunakan',

        'password.required' => 'Password siswa wajib diisi',
        'password.string' => 'Password siswa harus berupa teks',
        'password.min' => 'Password siswa minimal 8 karakter',
        'password.confirmed' => 'Konfirmasi password siswa tidak sama',

        'nama.required' => 'Nama siswa wajib diisi',
        'nama.string' => 'Nama siswa harus berupa teks',
        'nama.max' => 'Nama siswa maksimal 255 karakter',

        'kontak.string' => 'Kontak siswa harus berupa teks',
        'kontak.max' => 'Kontak siswa maksimal 255 karakter',

        'alamat.string' => 'Alamat siswa harus berupa teks',
        'alamat.max' => 'Alamat siswa maksimal 255 karakter',
    ];

    public function index()
    {
        try {
            $data = $this->model::with('kelas')->withCount('waliSiswa')->get();

            if ($data->isEmpty()) {
                return $this->errorResponse('Data '.$this->data_title.' kosong', 404);
            }

            return $this->successResponse(
                $data,
                'Data '.$this->data_title.' ditemukan',
                200
            );

        } catch (\Exception $e) {
            return $this->errorResponse(
                'Terjadi kesalahan pada server',
                500,
                app()->environment('local') ? [$e->getMessage()] : null
            );
        }
    }

    public function store(Request $request)
    {
        try {
            $validate = $request->validate($this->rules, $this->messages);

            // opsional: tambahkan jika ada validasi khusus...

            $data = $this->model::create($validate);

            if (!$data) {
                return $this->errorResponse('Data '.$this->data_title.' gagal dibuat', 500);
            }

            return $this->successResponse(
                $data,
                'Data '.$this->data_title.' berhasil dibuat',
                201
            );

        } catch (ValidationException $e) {
            return $this->validationErrorResponse($e->errors(), 'Informasi '.$this->data_title.' tidak valid' , 422);

        } catch (\Exception $e) {
            return $this->errorResponse(
                'Terjadi kesalahan pada server',
                500,
                app()->environment('local') ? [$e->getMessage()] : null
            );
        }
    }

    public function show($id)
    {
        $data = $this->model::with(['kelas', 'waliSiswa', 'mapels'])->find($id);

        if($data){
            return $this->successResponse(
                $data,
                'Data '.$this->data_title.' ditemukan',
                200
            );

        } else {
            return $this->errorResponse('Data '.$this->data_title.' tidak tersedia', 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $this->model::where($this->table_primary, $id)->firstOrFail();

             $this->rules = [
            'id_kelas' => 'required|exists:saka_kelas,id_kelas',
            'username' => 'required|string|max:255|unique:saka_siswa,username,'.$id.',id_siswa',
            'nama' => 'required|string|max:255',
            'kontak' => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:255',
        ];

            $validate = $request->validate($this->rules, $this->messages);

            $data->update($validate);

            return $this->successResponse(
                $data,
                'Data '.$this->data_title.' berhasil diperbarui',
                201
            );

        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('Data '.$this->data_title.' tidak tersedia', 404);

        } catch (ValidationException $e) {
            return $this->validationErrorResponse($e->errors(), 'Informasi '.$this->data_title.' tidak valid' , 422);

        } catch (\Exception $e) {
            return $this->errorResponse(
                'Terjadi kesalahan pada server',
                500,
                app()->environment('local') ? [$e->getMessage()] : null
            );
        }
    }
    
    public function updatePassword(Request $request, $id)
    {
        try {
            $data = $this->model::where($this->table_primary, $id)->firstOrFail();

            $this->rules = [
                'password' => 'required|string|min:8|confirmed',
            ];

            $this->messages = [
                'password.required' => 'Password siswa wajib diisi',
                'password.string' => 'Password siswa harus berupa teks',
                'password.min' => 'Password siswa minimal 8 karakter',
                'password.confirmed' => 'Konfirmasi password siswa tidak sama',
            ];

            $validate = $request->validate($this->rules, $this->messages);

            $data->update([
                'password' => Hash::make($validate['password']),
            ]);

            return $this->successResponse(
                $data,
                'Password '.$this->data_title.' berhasil diperbarui',
                200
            );

        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('Data '.$this->data_title.' tidak tersedia', 404);

        } catch (ValidationException $e) {
            return $this->validationErrorResponse(
                $e->errors(),
                'Informasi password '.$this->data_title.' tidak valid',
                422
            );

        } catch (\Exception $e) {
            return $this->errorResponse(
                'Terjadi kesalahan pada server',
                500,
                app()->environment('local') ? [$e->getMessage()] : null
            );
        }
}

    public function destroy($id)
    {
        $data = $this->model::find($id);

        if(empty($data)){
            return $this->errorResponse('Data '.$this->data_title.' tidak tersedia', 404);
        }

        try {
            $post = $data->delete();
            return $this->successResponse(
                $data,
                'Data '.$this->data_title.' berhasil dihapus',
                200
            );

        } catch (\Exception $e) {
            return $this->errorResponse(
                'Terjadi kesalahan pada server',
                500,
                app()->environment('local') ? [$e->getMessage()] : null
            );
        }
    }
}




