<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\SakaPengaturanNilaiAkhir;

class PengaturanNilaiAkhirController
{
    use ApiResponseTrait;

    protected $model = SakaPengaturanNilaiAkhir::class;
    protected $table_primary = 'id_pengaturan_nilai_akhir';
    protected $data_title = 'pengaturan nilai akhir';

    protected $rules = [
        'id_guru' => 'required|exists:saka_guru,id_guru',
        'id_mapel' => 'required|exists:saka_mapel,id_mapel',
        'pres_nilai_harian' => 'required|integer|min:0|max:100',
        'pres_nilai_assemen' => 'required|integer|min:0|max:100',
        'kkm' => 'required|integer|min:0|max:100',
    ];

    protected $messages = [
        'id_guru.required' => 'ID Guru wajib diisi',
        'id_guru.exists' => 'Guru tidak ditemukan',
        'id_mapel.required' => 'ID Mata Pelajaran wajib diisi',
        'id_mapel.exists' => 'Mata Pelajaran tidak ditemukan',
        'pres_nilai_harian.required' => 'Persentase nilai harian wajib diisi',
        'pres_nilai_harian.integer' => 'Persentase nilai harian harus berupa angka',
        'pres_nilai_harian.min' => 'Persentase nilai harian minimal 0',
        'pres_nilai_harian.max' => 'Persentase nilai harian maksimal 100',
        'pres_nilai_assemen.required' => 'Persentase nilai assemen wajib diisi',
        'pres_nilai_assemen.integer' => 'Persentase nilai assemen harus berupa angka',
        'pres_nilai_assemen.min' => 'Persentase nilai assemen minimal 0',
        'pres_nilai_assemen.max' => 'Persentase nilai assemen maksimal 100',
        'kkm.required' => 'KKM wajib diisi',
        'kkm.integer' => 'KKM harus berupa angka',
        'kkm.min' => 'KKM minimal 0',
        'kkm.max' => 'KKM maksimal 100',
    ];

    public function index()
    {
        try {
            $data = $this->model::with(['guru', 'mapel'])->get();

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

            // Validasi total persentase harus 100%
            $total = $validate['pres_nilai_harian'] + $validate['pres_nilai_assemen'];
            if ($total != 100) {
                return $this->errorResponse('Total persentase nilai harian dan assemen harus 100%', 422);
            }

            $data = $this->model::create($validate);

            if (!$data) {
                return $this->errorResponse('Data ' . $this->data_title . ' gagal dibuat', 500);
            }

            $data->load(['guru', 'mapel']);

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
        $data = $this->model::with(['guru', 'mapel'])->find($id);

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

            // Validasi total persentase harus 100%
            $total = $validate['pres_nilai_harian'] + $validate['pres_nilai_assemen'];
            if ($total != 100) {
                return $this->errorResponse('Total persentase nilai harian dan assemen harus 100%', 422);
            }

            $data->update($validate);

            $data->load(['guru', 'mapel']);

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