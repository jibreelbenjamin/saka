<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\SakaNilaiAkhir;

class NilaiAkhirController
{
    use ApiResponseTrait;

    protected $model = SakaNilaiAkhir::class;
    protected $table_primary = 'id_nilai_akhir';
    protected $data_title = 'nilai akhir';

    protected $rules = [
        'id_mapel' => 'required|exists:saka_mapel,id_mapel',
        'id_siswa' => 'required|exists:saka_siswa,id_siswa',
        'nilai' => 'required|numeric|min:0|max:100',
    ];

    protected $messages = [
        'id_mapel.required' => 'ID Mata Pelajaran wajib diisi',
        'id_mapel.exists' => 'Mata Pelajaran tidak ditemukan',
        'id_siswa.required' => 'ID Siswa wajib diisi',
        'id_siswa.exists' => 'Siswa tidak ditemukan',
        'nilai.required' => 'Nilai wajib diisi',
        'nilai.numeric' => 'Nilai harus berupa angka',
        'nilai.min' => 'Nilai minimal 0',
        'nilai.max' => 'Nilai maksimal 100',
    ];

    public function index()
    {
        try {
            $data = $this->model::with(['siswa', 'mapel'])->get();

            if ($data->isEmpty()) {
                return $this->errorResponse('Data ' . $this->data_title . ' kosong', 404);
            }

            return $this->successResponse($data, 'Data ' . $this->data_title . ' ditemukan', 200);

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
                return $this->errorResponse('Data ' . $this->data_title . ' gagal dibuat', 500);
            }

            $data->load(['siswa', 'mapel']);

            return $this->successResponse($data, 'Data ' . $this->data_title . ' berhasil dibuat', 201);

        } catch (ValidationException $e) {
            return $this->validationErrorResponse($e->errors(), 'Informasi ' . $this->data_title . ' tidak valid', 422);
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
        $data = $this->model::with(['siswa', 'mapel'])->find($id);

        if ($data) {
            return $this->successResponse($data, 'Data ' . $this->data_title . ' ditemukan', 200);
        } else {
            return $this->errorResponse('Data ' . $this->data_title . ' tidak tersedia', 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $this->model::where($this->table_primary, $id)->firstOrFail();

            $validate = $request->validate($this->rules, $this->messages);

            $data->update($validate);

            $data->load(['siswa', 'mapel']);

            return $this->successResponse($data, 'Data ' . $this->data_title . ' berhasil diperbarui', 200);

        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('Data ' . $this->data_title . ' tidak tersedia', 404);
        } catch (ValidationException $e) {
            return $this->validationErrorResponse($e->errors(), 'Informasi ' . $this->data_title . ' tidak valid', 422);
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

        if (empty($data)) {
            return $this->errorResponse('Data ' . $this->data_title . ' tidak tersedia', 404);
        }

        try {
            $data->delete();
            return $this->successResponse($data, 'Data ' . $this->data_title . ' berhasil dihapus', 200);
        } catch (\Exception $e) {
            return $this->errorResponse(
                'Terjadi kesalahan pada server',
                500,
                app()->environment('local') ? [$e->getMessage()] : null
            );
        }
    }
}