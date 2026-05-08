<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

use App\Models\SakaGuru;

class GuruController
{
    use ApiResponseTrait;

    protected $model = SakaGuru::class;
    protected $table_primary = 'id_guru';
    protected $data_title = 'guru';

    protected $rules = [
        'username' => 'required|string|max:255|unique:saka_guru,username',
        'password' => 'required|string|min:8|confirmed',
        'nama' => 'required|string|max:255',
    ];
    protected $messages = [
        'username.required' => 'Username wajib diisi',
        'username.string' => 'Username harus berupa teks',
        'username.max' => 'Username maksimal 255 karakter',
        'username.unique' => 'Username sudah digunakan',

        'password.required' => 'Password wajib diisi',
        'password.string' => 'Password harus berupa teks',
        'password.min' => 'Password minimal 8 karakter',
        'password.confirmed' => 'Konfirmasi password tidak sama',

        'nama.required' => 'Nama guru wajib diisi',
        'nama.string' => 'Nama guru harus berupa teks',
        'nama.max' => 'Nama guru maksimal 255 karakter',
    ];

    public function index()
    {
        try {
            $data = $this->model::withCount('mapels')->get();

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
        $data = $this->model::with('mapels')->find($id);

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

            // Rules khusus update, tanpa password
            $this->rules = [
                'username' => 'required|string|max:255|unique:saka_guru,username,'.$id.',id_guru',
                'nama' => 'required|string|max:255',
            ];

            $validate = $request->validate($this->rules, $this->messages);

            $data->update($validate);

            return $this->successResponse(
                $data,
                'Data '.$this->data_title.' berhasil diperbarui',
                200
            );

        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('Data '.$this->data_title.' tidak tersedia', 404);

        } catch (ValidationException $e) {
            return $this->validationErrorResponse(
                $e->errors(),
                'Informasi '.$this->data_title.' tidak valid',
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
    public function updatePassword(Request $request, $id)
{
    try {
        $data = $this->model::where($this->table_primary, $id)->firstOrFail();

        // Rules khusus update password
        $this->rules = [
            'password' => 'required|string|min:8|confirmed',
        ];

        $this->messages = [
            'password.required' => 'Password guru wajib diisi',
            'password.string' => 'Password guru harus berupa teks',
            'password.min' => 'Password guru minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password guru tidak sama',
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
