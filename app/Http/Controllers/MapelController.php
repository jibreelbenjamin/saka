<?php

namespace App\Http\Controllers;

use App\Models\SakaKomponenNilaiAssesmen;
use App\Models\SakaKomponenNilaiHarian;
use App\Models\SakaMapel;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    protected $route = 'mapel';
    protected $view = 'dashboard.mapel';
    protected $echo = 'mata pelajaran';

    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = SakaMapel::withCount(['gurus', 'komponenNilaiHarian', 'komponenNilaiAssesmen']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('kode_mapel', 'LIKE', "%{$search}%")
                    ->orWhere('nama_mapel', 'LIKE', "%{$search}%");
            });
        }

        $data = $query->orderBy('id_mapel', 'desc')
            ->paginate(15)
            ->withQueryString();

        return view($this->view . '.daftar', [
            'page' => $this->route,
            'page_title' => 'mata pelajaran',
            'page_variable' => 'mapel',
            'data' => $data,
            'search' => $search,
        ]);
    }

    public function create()
    {
        return view($this->view . '.form', [
            'page' => $this->route,
            'page_title' => 'mata pelajaran',
            'page_variable' => 'mapel',
        ]);
    }

    public function add(Request $request)
    {
        $validate = $request->validate([
            'kode_mapel' => 'required|string|max:255|unique:saka_mapel,kode_mapel',
            'nama_mapel' => 'required|string|max:255',
        ]);

        SakaMapel::create([
            'kode_mapel' => $validate['kode_mapel'],
            'nama_mapel' => $validate['nama_mapel'],
        ]);

        return redirect()->route($this->route)
            ->with(['successToast' => ucfirst($this->echo) . ' berhasil ditambahkan']);
    }

    public function setting(Request $request, $id)
    {
        $data = SakaMapel::with(['gurus'])
            ->where('id_mapel', $id)
            ->firstOrFail();

        $komponenHarian = SakaKomponenNilaiHarian::with('guru')
            ->where('id_mapel', $id)
            ->get()
            ->each(fn ($komponen) => $komponen->type = 'Harian');

        $komponenAssesmen = SakaKomponenNilaiAssesmen::with('guru')
            ->where('id_mapel', $id)
            ->get()
            ->each(fn ($komponen) => $komponen->type = 'Assesmen');

        $komponenNilai = $komponenHarian->concat($komponenAssesmen)
            ->sortBy('nama_komponen')
            ->values();

        $page = $request->input('page', 1);
        $perPage = 7;

        $komponenPaginated = new LengthAwarePaginator(
            $komponenNilai->forPage($page, $perPage),
            $komponenNilai->count(),
            $perPage,
            $page,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );

        return view($this->view . '.setting', [
            'page' => $this->route,
            'page_title' => 'mata pelajaran',
            'page_variable' => 'mapel',
            'data' => $data,
            'action_param' => $id,
            'komponenNilai' => $komponenPaginated,
        ]);
    }

    public function update(Request $request, $id)
    {
        $mapel = SakaMapel::where('id_mapel', $id)->firstOrFail();

        $validate = $request->validate([
            'kode_mapel' => 'required|string|max:255|unique:saka_mapel,kode_mapel,' . $id . ',id_mapel',
            'nama_mapel' => 'required|string|max:255',
        ]);

        $mapel->update([
            'kode_mapel' => $validate['kode_mapel'],
            'nama_mapel' => $validate['nama_mapel'],
        ]);

        return redirect()->route($this->route)
            ->with(['successToast' => ucfirst($this->echo) . ' berhasil diperbarui']);
    }

    public function delete($id)
    {
        SakaMapel::where('id_mapel', $id)->firstOrFail()->delete();

        return redirect()->route($this->route)
            ->with(['successToast' => ucfirst($this->echo) . ' berhasil dihapus']);
    }
}
