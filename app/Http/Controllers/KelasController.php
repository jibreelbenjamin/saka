<?php

namespace App\Http\Controllers;

use App\Models\SakaKelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    protected $model = SakaKelas::class;
    protected $route = 'kelas';
    protected $view = 'dashboard.kelas';
    protected $primary = 'id_kelas';
    protected $echo = 'kelas';

    protected $rules = [
        'kode_kelas' => 'required|string|max:255|unique:saka_kelas,kode_kelas',
        'nama_kelas' => 'required|string|max:255',
        'tingkat' => 'required|in:1,2,3',
    ];

    protected $messages = [
        'kode_kelas.required' => 'Kode kelas wajib diisi',
        'kode_kelas.max' => 'Kode kelas maksimal 255 karakter',
        'kode_kelas.unique' => 'Kode kelas sudah digunakan',
        'nama_kelas.required' => 'Nama kelas wajib diisi',
        'nama_kelas.max' => 'Nama kelas maksimal 255 karakter',
        'tingkat.required' => 'Tingkat wajib dipilih',
        'tingkat.in' => 'Tingkat harus berisi 1, 2, atau 3',
    ];

    public function index(Request $request)
    {
        $search = $request->input('search');
        $search_keys = ['kode_kelas', 'nama_kelas', 'tingkat'];

        $query = $this->model::query();

        $relations = [];
        foreach ($search_keys as $key) {
            if (str_contains($key, '.')) {
                $relation = explode('.', $key)[0];
                $relations[] = $relation;
            }
        }
        $query->with(array_unique($relations));
        
        if ($search) {
            $query->where(function($q) use ($search, $search_keys) {
                foreach ($search_keys as $key) {
                    if (str_contains($key, '.')) {
                        [$relation, $column] = explode('.', $key);
                        $q->orWhereHas($relation, function($q2) use ($column, $search) {
                            $q2->where($column, 'LIKE', "%{$search}%");
                        });
                    } else {
                        $q->orWhere($key, 'LIKE', "%{$search}%");
                    }
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
        return view($this->view.'.form');
    }

    public function add(Request $request)
    {
        // opsional: tambahkan jika ada validasi khusus...
        
        $validate = $request->validate($this->rules, $this->messages);
        $this->model::create($validate);
        return redirect()->route($this->route)->with(['successToast' => ucfirst($this->echo).' berhasil ditambahkan']);
    }

    public function setting($id)
    {
        $data = $this->model::find($id);

        if($data){
            return view($this->view.'.setting', compact('data'));
        } else {
            return redirect()->route($this->route)->withErrors(['message' => ucfirst($this->echo).' tidak ditemukan']);
        }
    }

    public function update(Request $request, $id)
    {
        $data = $this->model::where($this->primary, $id)->firstOrFail();

        if($data){
            // opsional: tambahkan jika ada validasi khusus...
            $rules = $this->rules;
            $rules['kode_kelas'] = "required|string|max:255|unique:saka_kelas,kode_kelas,{$id},{$this->primary}";

            $validate = $request->validate($rules, $this->messages); // varibel rules global ditimpa ulang oleh $rules
            $data->update($validate);

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

