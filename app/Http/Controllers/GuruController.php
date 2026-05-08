<?php

namespace App\Http\Controllers;

use App\Models\SakaGuru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    protected $model = SakaGuru::class;
    protected $route = 'guru';
    protected $view = 'dashboard.guru';
    protected $primary = 'id_guru';
    protected $echo = 'guru';

    protected $rules = [
        'username' => 'required|string|max:255|unique:saka_guru,username',
        'nama' => 'required|max:255',
        'password' => 'required|string|min:8',
    ];

    protected $messages = [
        'username.required' => 'Username wajib diisi',
        'username.string' => 'Username harus berupa teks',
        'username.max' => 'Username maksimal 255 karakter',
        'username.unique' => 'Username sudah digunakan',
        'nama.required' => 'Nama wajib diisi',
        'nama.string' => 'Nama harus berupa teks',
        'nama.max' => 'Nama maksimal 255 karakter',
        'password.required' => 'Password wajib diisi',
        'password.min' => 'Password minimal 8 karakter',
    ];

    public function index(Request $request)
    {
        $search = $request->input('search');
        $search_keys = ['id_guru', 'nama'];

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
        // password nya di hash
        $validate = $request->validate($this->rules, $this->messages);
        $validate['password'] = bcrypt($validate['password']);
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
                
            $rules = $this->rules;
            
            $rules['username'] = 'required|string|max:255|unique:saka_guru,username,'.$id.',id_guru';
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

    public function delete($id)
    {
        $this->model::findOrFail($id)->delete();
        return redirect()->route($this->route)->with(['successToast' => ucfirst($this->echo).' berhasil dihapus']);
    }
}
