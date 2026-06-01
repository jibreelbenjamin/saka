<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\SakaAksesMapel;

class AksesMapelController
{
    use ApiResponseTrait;

    protected $model = SakaAksesMapel::class;
    protected $table_primary = 'id_akses_mapel';
    protected $data_title = 'akses mapel';

    protected $rules = [
        'id_mapel' => 'required|exists:saka_mapel,id_mapel',
        'id_kelas' => 'required|exists:saka_kelas,id_kelas',
        'id_guru' => 'required|exists:saka_guru,id_guru',
    ];
    protected $messages = [
        'id_mapel.required' => 'ID mapel wajib diisi',
        'id_mapel.exists' => 'ID mapel tidak ditemukan',
        'id_kelas.required' => 'ID kelas wajib diisi',
        'id_kelas.exists' => 'ID kelas tidak ditemukan',
        'id_guru.required' => 'ID guru wajib diisi',
        'id_guru.exists' => 'ID guru tidak ditemukan',
    ];

    public function index()
    {
        try {
            $data = $this->model::with(['mapel', 'guru', 'kelas'])->withCount(['mapel', 'guru', 'kelas'])->get(); 


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
        $data = $this->model::with(['mapel', 'guru', 'kelas'])->find($id);


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




