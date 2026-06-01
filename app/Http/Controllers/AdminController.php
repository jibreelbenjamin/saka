<?php

namespace App\Http\Controllers;

use App\Models\SakaAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    protected $model = SakaAdmin::class;
    protected $route = 'admin';
    protected $view = 'dashboard.admin';
    protected $primary = 'id_admin';
    protected $echo = 'admin';
    
    protected $rules = [
        'username' => 'required|string|max:255|unique:saka_admin,username',
        'password' => 'required|confirmed|string|min:8',
        'nama' => 'required|string|max:255',
    ];

    protected $messages = [
        'username.required' => 'Username admin wajib diisi',
        'username.string' => 'Username admin harus berupa teks',
        'username.max' => 'Username admin maksimal 255 karakter',
        'username.unique' => 'Username admin sudah digunakan',

        'password.required' => 'Password admin wajib diisi',
        'password.string' => 'Password admin harus berupa teks',
        'password.min' => 'Password admin minimal 8 karakter',
        'password.confirmed' => 'Konfirmasi password tidak cocok',

        'nama.required' => 'Nama admin wajib diisi',
        'nama.string' => 'Nama admin harus berupa teks',
        'nama.max' => 'Nama admin maksimal 255 karakter',
    ];

    public function index(Request $request)
    {
        $search = $request->input('search');
        $search_keys = ['username', 'nama'];

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
            // Rules khusus update, password tidak dimasukkan
            $this->rules = [
                'username' => 'required|string|max:255|unique:saka_admin,username,'.$id.',id_admin',
                'nama' => 'required|string|max:255',
            ];
            $validate = $request->validate($this->rules, $this->messages);
            $data->update($validate);

            return redirect()->route($this->route)->with(['successToast' => ucfirst($this->echo).' berhasil diperbarui']);
        } else {
            return redirect()->route($this->route)->withErrors(['message' => ucfirst($this->echo).' tidak ditemukan']);
        }
    }

    public function updatePassword(Request $request, $id)
        {
        $data = $this->model::where($this->primary, $id)->firstOrFail();

        if ($data) {
            // Rules khusus update password
            $this->rules = [
                'password' => 'required|string|min:8|confirmed',
            ];

            $this->messages = [
                'password.required' => 'Password admin wajib diisi',
                'password.string' => 'Password admin harus berupa teks',
                'password.min' => 'Password admin minimal 8 karakter',
                'password.confirmed' => 'Konfirmasi password admin tidak sama',
            ];

            $validate = $request->validate($this->rules, $this->messages);

            $data->update([
                'password' => Hash::make($validate['password']),
            ]);

            return redirect()
                ->route($this->route.'.setting', $id)
                ->with(['successToast' => 'Password '.ucfirst($this->echo).' berhasil diperbarui']);
        } else {
            return redirect()
                ->route($this->route)
                ->withErrors(['message' => ucfirst($this->echo).' tidak ditemukan']);
        }
    }   

    public function delete($id)
    {
        $this->model::findOrFail($id)->delete();
        return redirect()->route($this->route)->with(['successToast' => ucfirst($this->echo).' berhasil dihapus']);
    } 
}


