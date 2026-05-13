<?php

namespace App\Http\Controllers;

use App\Models\SakaWaliSiswa;
use App\Models\SakaSiswa;
use Illuminate\Http\Request;

class WaliSiswaController extends Controller
{
    protected $model = SakaWaliSiswa::class;
    protected $model_siswa = SakaSiswa::class;
    protected $route = 'siswa.setting';
    protected $view = 'dashboard.wali-siswa';
    protected $primary = 'id_wali_siswa';
    protected $echo = 'wali siswa';

    protected $rules = [
        'nama_wali'   => 'required|string|max:255',
        'kontak'      => 'nullable|string',
        'alamat'      => 'nullable|string|max:255',
        'status_wali' => 'required|string|max:255'
    ];

    protected $messages = [
        'nama_wali.required'      => 'Nama wali wajib diisi',
        'nama_wali.string'        => 'Nama wali harus berupa teks',
        'nama_wali.max'           => 'Nama wali maksimal 255 karakter',
        'alamat.max'              => 'Alamat maksimal 255 karakter',
        'status_wali.required'    => 'Status wali wajib diisi',
        'status_wali.in'          => 'Status wali tidak valid'
    ];

    public function create($id_siswa)
    {
        $siswa = $this->model_siswa::findOrFail($id_siswa);
        return view($this->view.'.form', compact('siswa'));
    }

    public function add(Request $request, $id_siswa)
    {
        $this->model_siswa::findOrFail($id_siswa);

        $validate = $request->validate($this->rules, $this->messages);
        $validate['id_siswa'] = $id_siswa;

        $this->model::create($validate);
        return redirect()->route($this->route, $id_siswa)->with(['successToast' => ucfirst($this->echo).' berhasil ditambahkan']);
    }

    public function setting($id_siswa, $id)
    {
        $data = $this->model::where($this->primary, $id)->where('id_siswa', $id_siswa)->firstOrFail();

        return view($this->view.'.setting', compact('data', 'id_siswa'));
    }

    public function update(Request $request, $id_siswa, $id)
    {
        $data = $this->model::where($this->primary, $id)->where('id_siswa', $id_siswa)->firstOrFail();

        if($data) {
            $validate = $request->validate($this->rules, $this->messages);
            $data->update($validate);

            return redirect()->route($this->route, $id_siswa)->with(['successToast' => ucfirst($this->echo).' berhasil diperbarui']);
        } else {
            return redirect()->route($this->route, $id_siswa)->withErrors(['message' => ucfirst($this->echo).' tidak ditemukan']);
        }
    }

    public function delete($id_siswa, $id)
    {
        $this->model::where($this->primary, $id)->where('id_siswa', $id_siswa)->firstOrFail()->delete();

        return redirect()->route($this->route, $id_siswa)->with(['successToast' => ucfirst($this->echo).' berhasil dihapus']);
    }
}