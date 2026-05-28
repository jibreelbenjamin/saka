<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\SakaMapel;

class MapelController
{
    use ApiResponseTrait;

    protected $model = SakaMapel::class;
    protected $table_primary = 'id_mapel';
    protected $data_title = 'mapel';

    protected $rules = [
        'kode_mapel' => 'required|string|max:50|unique:saka_mapel,kode_mapel',
        'nama_mapel' => 'required|string|max:255',
    ];
    protected $messages = [
        'kode_mapel.required' => 'Kode mapel wajib diisi',
        'kode_mapel.string' => 'Kode mapel harus berupa string',
        'kode_mapel.max' => 'Kode mapel maksimal 50 karakter',
        'kode_mapel.unique' => 'Kode mapel sudah digunakan',
        'nama_mapel.required' => 'Nama mapel wajib diisi',
        'nama_mapel.string' => 'Nama mapel harus berupa string',
        'nama_mapel.max' => 'Nama mapel maksimal 255 karakter',
    ];

    public function index()
    {
        try {
            $data = $this->model::withCount(['gurus', 'komponenNilaiHarian', 'komponenNilaiAssesmen', 'aksesMapel'])->get();

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
        $data = $this->model::with(['gurus', 'komponenNilaiHarian', 'komponenNilaiAssesmen', 'aksesMapel'])->find($id);

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

            $rules = $this->rules;
            $rules['kode_mapel'] .= ','.$id.','.$this->table_primary;

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




