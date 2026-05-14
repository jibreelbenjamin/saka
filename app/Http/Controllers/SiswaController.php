<?php

namespace App\Http\Controllers;

use App\Models\SakaSiswa;
use App\Models\SakaKelas;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    protected $model = SakaSiswa::class;
    protected $route = 'siswa';
    protected $view = 'dashboard.siswa';
    protected $primary = 'id_siswa';
    protected $echo = 'siswa';

    protected $rules = [
        'username' => 'required|string|max:255|unique:saka_siswa,username',
        'password' => 'required|string|min:8',
        'nama' => 'required|max:255',
        'kontak' => 'required|string',
        'alamat' => 'required|max:255',
        'id_kelas' => 'required|exists:saka_kelas,id_kelas',
    ];

    protected $messages = [
        'username.required' => 'Username wajib diisi',
        'username.string' => 'Username harus berupa teks',
        'username.max' => 'Username maksimal 255 karakter',
        'username.unique' => 'Username sudah digunakan',
        'password.required' => 'Password wajib diisi',
        'password.min' => 'Password minimal 8 karakter',
        'nama.required' => 'Nama wajib diisi',
        'nama.string' => 'Nama harus berupa teks',
        'nama.max' => 'Nama maksimal 255 karakter',
        'kontak.required' => 'Kontak wajib diisi',
        'alamat.required' => 'Alamat wajib diisi',
        'alamat.max' => 'Alamat maksimal 255 karakter',
        'id_kelas.required' => 'Kelas wajib diisi',
        'id_kelas.exists' => 'Kelas tidak valid',
    ];

    public function index(Request $request)
    {
        $search = $request->input('search');
        $search_keys = ['nama', 'kontak', 'alamat', 'username'];

        $query = $this->model::with('kelas');

        if ($search) {
            $query->where(function($q) use ($search, $search_keys) {
                foreach ($search_keys as $key) {
                    $q->orWhere($key, 'LIKE', "%{$search}%");
                }
            });
        }

        $data = $query->orderBy($this->primary, 'desc')
                    ->paginate(15)
                    ->withQueryString();
        return view($this->view.'.daftar', compact('data', 'search'));
    }

    public function create()
    {
        $data = SakaKelas::all();
        return view($this->view.'.form', compact('data'));
    }

    public function add(Request $request)
    {
        // password nya di hash
        $validate = $request->validate($this->rules, $this->messages);
        $validate['password'] = bcrypt($validate['password']);
        $this->model::create($validate);
        return redirect()->route($this->route)->with(['successToast' => ucfirst($this->echo).' berhasil ditambahkan']);
    }

    public function setting($id)
    {
        $data = $this->model::find($id);
        $kelas = SakaKelas::all();

        if($data){
            return view($this->view.'.setting', compact('data', 'kelas'));
        } else {
            return redirect()->route($this->route)->withErrors(['message' => ucfirst($this->echo).' tidak ditemukan']);
        }
    }

    public function update(Request $request, $id)
    {
        $data = $this->model::where($this->primary, $id)->firstOrFail();

        if($data){
                
            $rules = $this->rules;
            
            $rules['username'] = 'required|string|max:255|unique:saka_siswa,username,'.$id.',id_siswa';
            $rules['password'] = 'nullable|string|min:8';

            $validate = $request->validate($rules, $this->messages);

            if (empty($validate['password'])) {
                unset($validate['password']);
            } else {
                $validate['password'] = bcrypt($validate['password']);
            }

            $data->update($validate);

            return redirect()->route($this->route)->with(['successToast' => ucfirst($this->echo).' berhasil diperbarui']);
        } else {
            return redirect()->route($this->route)->withErrors(['message' => ucfirst($this->echo).' tidak ditemukan']);
        }
    }

    public function updatePassword(Request $request, $id)
    {
        $data = $this->model::where($this->primary, $id)->firstOrFail();

        if($data){
            $rules = [
                'password' => 'required|string|min:8|max:255|confirmed',
            ];

            $messages = [
                'password.required' => 'Password wajib diisi',
                'password.min' => 'Password minimal 8 karakter',
                'password.max' => 'Password maksimal 255 karakter',
                'password.confirmed' => 'Konfirmasi password tidak cocok',
            ];

            $validate = $request->validate($rules, $messages);
            $data->update(['password' => bcrypt($validate['password'])]);

            return redirect()->route($this->route)->with(['successToast' => ucfirst($this->echo).' berhasil diperbarui']);
        } else {
            return redirect()->route($this->route)->withErrors(['message' => ucfirst($this->echo).' tidak ditemukan']);
        }
    }   

    public function delete($id)
    {
        $this->model::findOrFail($id)->delete();
        return redirect()->route($this->route)->with(['successToast' => ucfirst($this->echo).' berhasil dihapus']);
    }
}