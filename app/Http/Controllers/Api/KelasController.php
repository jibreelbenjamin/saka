<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\SakaKelas;

class KelasController
{
    use ApiResponseTrait;

    protected $model = SakaKelas::class;
    protected $table_primary = 'id_kelas';
    protected $data_title = 'kelas';

    protected $rules = [
        'kode_kelas' => 'required|string|regex:/^[a-zA-Z0-9_\-]+$/|max:255|unique:saka_kelas',
        'nama_kelas' => 'required|string|max:255',
        'tingkat' => 'required|in:1,2,3',
    ];
    protected $messages = [
        'kode_kelas.required' => 'Kode kelas wajib diisi',
        'kode_kelas.max' => 'Kode kelas maksimal 255 karakter',
        'kode_kelas.regex' => 'Kode kelas tidak boleh mengandung karakter spesial kecuali underscore dan dash',
        'kode_kelas.unique' => 'Kode kelas sudah digunakan',
        'nama_kelas.required' => 'Nama kelas wajib diisi',
        'nama_kelas.max' => 'Nama kelas maksimal 255 karakter',
        'tingkat.required' => 'Tingkat kelas wajib diisi',
        'tingkat.in' => 'Tingkat kelas tidak tersedia',
    ];

    public function index()
    {
        try {
            $data = $this->model::withCount('siswas')->get();

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
        $data = $this->model::with('siswas.kelas')->find($id);

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

            // opsional: tambahkan jika ada validasi khusus...
            $rules = $this->rules;
            $rules['kode_kelas'] = "required|string|max:255|regex:/^[^\s]+$/|unique:saka_kelas,kode_kelas,{$id},{$this->table_primary}";

            $validate = $request->validate($rules, $this->messages);

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