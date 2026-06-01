<?php

namespace App\Http\Controllers;

use App\Models\SakaMapel;
use App\Models\SakaGuru;
use App\Models\SakaTahunAjaran;
use App\Models\SakaKomponenNilaiHarian;
use App\Models\SakaKomponenNilaiAssesmen;
use Illuminate\Http\Request;

class KomponenNilaiController extends Controller
{
    protected $route = 'komponen-nilai';
    protected $view = 'dashboard.komponen-nilai';
    protected $echo = 'komponen nilai';

    protected $typeOptions = [
        'harian' => 'Nilai Harian',
        'assesmen' => 'Nilai Assesmen',
    ];

    protected $messages = [
        'kode_komponen.required' => 'Kode komponen wajib diisi',
        'kode_komponen.string' => 'Kode komponen harus berupa teks',
        'kode_komponen.max' => 'Kode komponen maksimal 255 karakter',
        'kode_komponen.unique' => 'Kode komponen sudah digunakan',
        'nama_komponen.required' => 'Nama komponen wajib diisi',
        'nama_komponen.string' => 'Nama komponen harus berupa teks',
        'nama_komponen.max' => 'Nama komponen maksimal 255 karakter',
        'id_mapel.required' => 'Mata pelajaran wajib dipilih',
        'id_mapel.exists' => 'Mata pelajaran tidak valid',
        'id_guru.required' => 'Guru wajib dipilih',
        'id_guru.exists' => 'Guru tidak valid',
        'id_tahun_ajaran.required' => 'Tahun ajaran wajib dipilih',
        'id_tahun_ajaran.exists' => 'Tahun ajaran tidak valid',
        'kkm.integer' => 'KKM harus berupa angka',
        'kkm.min' => 'KKM minimal 0',
        'kkm.max' => 'KKM maksimal 100',
        'is_active.required' => 'Status aktif wajib dipilih',
        'is_active.boolean' => 'Status aktif tidak valid',
    ];

    protected function getTypeConfig(string $type)
    {
        $type = strtolower($type);
        if ($type === 'assesmen') {
            return [
                'name' => 'assesmen',
                'label' => 'nilai assesmen',
                'model' => SakaKomponenNilaiAssesmen::class,
                'code' => 'kode_komponen_assesmen',
                'primary' => 'id_komponen_nilai_assesmen',
                'table' => 'saka_komponen_nilai_assesmen',
            ];
        }

        return [
            'name' => 'harian',
            'label' => 'nilai harian',
            'model' => SakaKomponenNilaiHarian::class,
            'code' => 'kode_komponen_harian',
            'primary' => 'id_komponen_nilai_harian',
            'table' => 'saka_komponen_nilai_harian',
        ];
    }

    protected function resolveType(string $type)
    {
        return in_array(strtolower($type), array_keys($this->typeOptions)) ? strtolower($type) : 'harian';
    }

    public function index(Request $request)
    {
        $type = $this->resolveType($request->input('type', 'harian'));
        $config = $this->getTypeConfig($type);
        $search = $request->input('search');

        $query = $config['model']::with(['mapel', 'guru', 'tahunAjaran']);

        if ($search) {
            $query->where(function ($q) use ($search, $config) {
                $q->where($config['code'], 'LIKE', "%{$search}%")
                    ->orWhere('nama_komponen', 'LIKE', "%{$search}%");
            });
        }

        $data = $query->orderBy($config['primary'], 'desc')
            ->paginate(15)
            ->withQueryString();

        return view($this->view . '.daftar', [
            'page' => $this->route,
            'page_title' => 'komponen nilai',
            'page_variable' => 'komponen_nilai',
            'data' => $data,
            'search' => $search,
            'type' => $type,
            'typeLabel' => $config['label'],
            'typeOptions' => $this->typeOptions,
            'typeConfig' => $config,
        ]);
    }

    public function create(Request $request)
    {
        $type = $this->resolveType($request->input('type', 'harian'));
        $config = $this->getTypeConfig($type);

        return view($this->view . '.form', [
            'page' => $this->route,
            'page_title' => 'komponen nilai',
            'page_variable' => 'komponen_nilai',
            'type' => $type,
            'typeLabel' => $config['label'],
            'mapels' => SakaMapel::orderBy('nama_mapel')->get(),
            'gurus' => SakaGuru::orderBy('nama')->get(),
            'tahunAjarans' => SakaTahunAjaran::orderByDesc('tahun_mulai')->get(),
        ]);
    }

    public function add(Request $request)
    {
        $type = $this->resolveType($request->input('type', 'harian'));
        $config = $this->getTypeConfig($type);

        $rules = [
            'kode_komponen' => 'required|string|max:255|unique:' . $config['table'] . ',' . $config['code'],
            'nama_komponen' => 'required|string|max:255',
            'id_mapel' => 'required|exists:saka_mapel,id_mapel',
            'id_guru' => 'required|exists:saka_guru,id_guru',
            'id_tahun_ajaran' => 'required|exists:saka_tahun_ajaran,id_tahun_ajaran',
            'kkm' => 'nullable|integer|min:0|max:100',
            'is_active' => 'required|boolean',
        ];

        $validate = $request->validate($rules, $this->messages);

        $payload = [
            $config['code'] => $validate['kode_komponen'],
            'nama_komponen' => $validate['nama_komponen'],
            'id_mapel' => $validate['id_mapel'],
            'id_guru' => $validate['id_guru'],
            'id_tahun_ajaran' => $validate['id_tahun_ajaran'],
            'kkm' => $validate['kkm'] ?? 0,
            'is_active' => $validate['is_active'],
        ];

        $config['model']::create($payload);

        return redirect()->route($this->route, ['type' => $type])
            ->with(['successToast' => ucfirst($this->echo) . ' ' . $config['label'] . ' berhasil ditambahkan']);
    }

    public function setting(string $type, $id)
    {
        $type = $this->resolveType($type);
        $config = $this->getTypeConfig($type);

        $data = $config['model']::with(['mapel', 'guru', 'tahunAjaran'])
            ->where($config['primary'], $id)
            ->first();

        if ($data) {
            return view($this->view . '.setting', [
                'page' => $this->route,
                'page_title' => 'komponen nilai',
                'page_variable' => 'komponen_nilai',
                'type' => $type,
                'typeLabel' => $config['label'],
                'typeConfig' => $config,
                'data' => $data,
                'mapels' => SakaMapel::orderBy('nama_mapel')->get(),
                'gurus' => SakaGuru::orderBy('nama')->get(),
                'tahunAjarans' => SakaTahunAjaran::orderByDesc('tahun_mulai')->get(),
                'action_param' => $id,
            ]);
        }

        return redirect()->route($this->route, ['type' => $type])
            ->withErrors(['message' => ucfirst($this->echo) . ' tidak ditemukan']);
    }

    public function update(Request $request, string $type, $id)
    {
        $type = $this->resolveType($type);
        $config = $this->getTypeConfig($type);

        $data = $config['model']::where($config['primary'], $id)->firstOrFail();

        $rules = [
            'kode_komponen' => 'required|string|max:255|unique:' . $config['table'] . ',' . $config['code'] . ',' . $id . ',' . $config['primary'],
            'nama_komponen' => 'required|string|max:255',
            'id_mapel' => 'required|exists:saka_mapel,id_mapel',
            'id_guru' => 'required|exists:saka_guru,id_guru',
            'id_tahun_ajaran' => 'required|exists:saka_tahun_ajaran,id_tahun_ajaran',
            'kkm' => 'nullable|integer|min:0|max:100',
            'is_active' => 'required|boolean',
        ];

        $validate = $request->validate($rules, $this->messages);

        $payload = [
            $config['code'] => $validate['kode_komponen'],
            'nama_komponen' => $validate['nama_komponen'],
            'id_mapel' => $validate['id_mapel'],
            'id_guru' => $validate['id_guru'],
            'id_tahun_ajaran' => $validate['id_tahun_ajaran'],
            'kkm' => $validate['kkm'] ?? 0,
            'is_active' => $validate['is_active'],
        ];

        $data->update($payload);

        return redirect()->route($this->route, ['type' => $type])
            ->with(['successToast' => ucfirst($this->echo) . ' ' . $config['label'] . ' berhasil diperbarui']);
    }

    public function delete(string $type, $id)
    {
        $type = $this->resolveType($type);
        $config = $this->getTypeConfig($type);

        $config['model']::findOrFail($id)->delete();

        return redirect()->route($this->route, ['type' => $type])
            ->with(['successToast' => ucfirst($this->echo) . ' ' . $config['label'] . ' berhasil dihapus']);
    }
}
