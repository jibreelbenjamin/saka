<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\SakaWalisiswa;

class WaliSiswaController
{
    use ApiResponseTrait;

    protected $model = SakaWalisiswa::class;
    protected $table_primary = 'id_wali_siswa';
    protected $data_title = 'wali siswa';

    protected $rules = [
        'id_siswa' => 'required|exists:saka_siswa,id_siswa',
        'nama_wali' => 'required|string|max:255',
        'kontak' => 'nullable|string|max:255',
        'alamat' => 'nullable|string|max:255',
        'status_wali' => 'nullable|string|max:255',
    ];
    protected $messages = [
        'id_siswa.required' => 'Siswa wajib dipilih',
        'id_siswa.exists' => 'Siswa tidak valid',

        'nama_wali.required' => 'Nama wali siswa wajib diisi',
        'nama_wali.string' => 'Nama wali siswa harus berupa teks',
        'nama_wali.max' => 'Nama wali siswa maksimal 255 karakter',

        'kontak.string' => 'Kontak wali siswa harus berupa teks',
        'kontak.max' => 'Kontak wali siswa maksimal 255 karakter',

        'alamat.string' => 'Alamat wali siswa harus berupa teks',
        'alamat.max' => 'Alamat wali siswa maksimal 255 karakter',

        'status_wali.string' => 'Status wali siswa harus berupa teks',
        'status_wali.max' => 'Status wali siswa maksimal 255 karakter',
    ];

    public function index()
    {
        try {
            $data = $this->model::with('siswa')->get();

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
        $data = $this->model::with('siswa')->find($id);

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




