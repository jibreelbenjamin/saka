<?php

namespace App\Http\Controllers;

use App\Models\SakaMapel;
use App\Models\SakaSiswa;
use App\Models\SakaAksesMapel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DataNilaiController extends Controller
{
    // protected $model = Saka....::class;
    protected $route = 'data-nilai';
    protected $view = 'dashboard.data-nilai';
    // protected $primary = 'id_...';
    protected $echo = '...';

    public function introMapel(){
        $id_guru = Auth::guard('guru')->user()->id_guru ?? null;

        $data = SakaMapel::whereHas('aksesMapel', function($q) use ($id_guru) {
            $q->where('id_guru', $id_guru);
        })
        ->withCount(['aksesMapel as jumlah_kelas' => function($query) use ($id_guru) {
            $query->where('id_guru', $id_guru);
        }])
        ->get() ?? [];

        return view($this->view.'.intro-mapel', compact('data'));
    }

    public function introKelas(Request $request){
        $id_guru = Auth::guard('guru')->user()->id_guru ?? null;
        $id_mapel = $request->id_mapel;

        if (!$id_mapel) {
            return redirect()->back()->withErrors('Mata pelajaran wajib dipilih');
        }

        if (!$id_guru) {
            $data = collect();
            $mapel = collect();
        } else {
            $data = SakaAksesMapel::with(['kelas', 'mapel'])
                ->withCount('kelas')
                ->where('id_guru', $id_guru)
                ->where('id_mapel', $id_mapel)
                ->get()
                ->map(function($item) {
                    // Menambahkan jumlah siswa ke objek kelas
                    $kelas = $item->kelas;
                    if ($kelas) {
                        $kelas->jumlah_siswa = SakaSiswa::where('id_kelas', $kelas->id_kelas)->count();
                    }
                    return $kelas;
                })
                ->filter();
            
            $mapel = SakaMapel::find($id_mapel);
        }

        return view($this->view . '.intro-kelas', compact('data', 'mapel', 'id_mapel'));
    }

    public function go(Request $request){
        $id_mapel = $request->id_mapel;
        $id_kelas = $request->id_kelas;

        if (!$id_mapel) {
            return redirect()->back()->withErrors('Mata pelajaran invalid');
        }
        if (!$id_kelas) {
            return redirect()->back()->withErrors('Kelas wajib dipilih');
        }

        return redirect()->route($this->route . '.daftar', [$id_mapel, $id_kelas]);
    }

    public function index($id_mapel, $id_kelas){
        $id_guru = Auth::guard('guru')->user()->id_guru ?? null;

        // 1. Verifikasi akses guru ke mapel dan kelas
        $akses = \App\Models\SakaAksesMapel::where('id_guru', $id_guru)
            ->where('id_mapel', $id_mapel)
            ->where('id_kelas', $id_kelas)
            ->first();

        if (!$akses) {
            return response()->json([
                'status' => false,
                'message' => 'Anda tidak memiliki akses ke kelas ini pada mata pelajaran tersebut.'
            ], 403);
        }

        // 2. Ambil data siswa berdasarkan id_kelas
        $siswa = \App\Models\SakaSiswa::where('id_kelas', $id_kelas)
            ->orderBy('nama')
            ->get();

        // 3. Ambil komponen nilai harian untuk mapel ini
        $komponenHarian = \App\Models\SakaKomponenNilaiHarian::where('id_mapel', $id_mapel)
            ->where('id_guru', $id_guru)
            ->where('is_active', true)
            ->get();

        // 4. Ambil komponen nilai assesmen untuk mapel ini
        $komponenAssesmen = \App\Models\SakaKomponenNilaiAssesmen::where('id_mapel', $id_mapel)
            ->where('id_guru', $id_guru)
            ->where('is_active', true)
            ->get();

        // 5. Ambil nilai harian untuk setiap siswa
        $nilaiHarian = \App\Models\SakaNilaiHarian::whereIn('id_siswa', $siswa->pluck('id_siswa'))
            ->whereIn('id_komponen_nilai_harian', $komponenHarian->pluck('id_komponen_nilai_harian'))
            ->get()
            ->groupBy('id_siswa');

        // 6. Ambil nilai assesmen untuk setiap siswa
        $nilaiAssesmen = \App\Models\SakaNilaiAssesmen::whereIn('id_siswa', $siswa->pluck('id_siswa'))
            ->whereIn('id_komponen_nilai_assesmen', $komponenAssesmen->pluck('id_komponen_nilai_assesmen'))
            ->get()
            ->groupBy('id_siswa');

        // 7. Ambil nilai akhir jika ada
        $nilaiAkhir = \App\Models\SakaNilaiAkhir::where('id_mapel', $id_mapel)
            ->whereIn('id_siswa', $siswa->pluck('id_siswa'))
            ->get()
            ->keyBy('id_siswa');

        // 8. Ambil pengaturan nilai akhir
        $pengaturan = \App\Models\SakaPengaturanNilaiAkhir::where('id_guru', $id_guru)
            ->where('id_mapel', $id_mapel)
            ->first();

        // 9. Ambil simpanan nilai untuk setiap siswa
        $simpananNilai = \App\Models\SakaSimpananNilai::where('id_guru', $id_guru)
            ->where('id_mapel', $id_mapel)
            ->whereIn('id_siswa', $siswa->pluck('id_siswa'))
            ->get()
            ->keyBy('id_siswa');

        // 10. Siapkan data untuk response
        $data = [
                'mapel' => [
                    'id_mapel' => $id_mapel,
                    'kode_mapel' => $akses->mapel->kode_mapel,
                    'nama_mapel' => $akses->mapel->nama_mapel ?? 'Mata Pelajaran',
                ],
                'kelas' => [
                    'id_kelas' => $id_kelas,
                    'kode_kelas' => $akses->kelas->kode_kelas,
                    'nama_kelas' => $akses->kelas->nama_kelas ?? 'Kelas',
                ],
                'guru' => [
                    'id_guru' => $id_guru,
                    'nama_guru' => $akses->guru->nama ?? 'Guru',
                ],
                'pengaturan_nilai_akhir' => $pengaturan ? [
                    'id_pengaturan_nilai_akhir' => $pengaturan->id_pengaturan_nilai_akhir,
                    'pres_nilai_harian' => $pengaturan->pres_nilai_harian,
                    'pres_nilai_assesmen' => $pengaturan->pres_nilai_assesmen,
                    'kkm' => $pengaturan->kkm,
                ] : null,
                'komponen_nilai_harian' => $komponenHarian->map(function($item) {
                    return [
                        'id_komponen' => $item->id_komponen_nilai_harian,
                        'kode_komponen' => $item->kode_komponen_harian,
                        'nama_komponen' => $item->nama_komponen,
                        'kkm' => $item->kkm,
                    ];
                }),
                'komponen_nilai_assesmen' => $komponenAssesmen->map(function($item) {
                    return [
                        'id_komponen' => $item->id_komponen_nilai_assesmen,
                        'kode_komponen' => $item->kode_komponen_assesmen,
                        'nama_komponen' => $item->nama_komponen,
                        'kkm' => $item->kkm,
                    ];
                }),
                'siswa' => $siswa->map(function($item) use ($nilaiHarian, $nilaiAssesmen, $nilaiAkhir, $komponenHarian, $komponenAssesmen, $simpananNilai, $pengaturan) {
                    // Data nilai harian per siswa
                    $nilaiHarianSiswa = [];
                    $totalNilaiHarian = 0;
                    $jumlahKomponenHarian = $komponenHarian->count();
                    
                    foreach ($komponenHarian as $kh) {
                        $nilai = $nilaiHarian->get($item->id_siswa);
                        $nilaiObj = $nilai ? $nilai->firstWhere('id_komponen_nilai_harian', $kh->id_komponen_nilai_harian) : null;
                        $nilaiValue = $nilaiObj ? $nilaiObj->nilai : 0;
                        
                        $nilaiHarianSiswa[] = [
                            'id_nilai' => $nilaiObj ? $nilaiObj->id_nilai_harian : null,
                            'id_komponen' => $kh->id_komponen_nilai_harian,
                            'nama_komponen' => $kh->nama_komponen,
                            'kkm' => $kh->kkm,
                            'nilai' => $nilaiValue,
                        ];
                        
                        $totalNilaiHarian += $nilaiValue;
                    }
                    
                    // Rata-rata nilai harian
                    $rataNilaiHarian = $jumlahKomponenHarian > 0 ? round($totalNilaiHarian / $jumlahKomponenHarian, 2) : 0;
                    
                    // Data nilai assesmen per siswa
                    $nilaiAssesmenSiswa = [];
                    $totalNilaiAssesmen = 0;
                    $jumlahKomponenAssesmen = $komponenAssesmen->count();
                    
                    foreach ($komponenAssesmen as $ka) {
                        $nilai = $nilaiAssesmen->get($item->id_siswa);
                        $nilaiObj = $nilai ? $nilai->firstWhere('id_komponen_nilai_assesmen', $ka->id_komponen_nilai_assesmen) : null;
                        $nilaiValue = $nilaiObj ? $nilaiObj->nilai : 0;
                        
                        $nilaiAssesmenSiswa[] = [
                            'id_nilai' => $nilaiObj ? $nilaiObj->id_nilai_assesmen : null,
                            'id_komponen' => $ka->id_komponen_nilai_assesmen,
                            'nama_komponen' => $ka->nama_komponen,
                            'kkm' => $ka->kkm,
                            'nilai' => $nilaiValue,
                        ];
                        
                        $totalNilaiAssesmen += $nilaiValue;
                    }
                    
                    // Rata-rata nilai assesmen
                    $rataNilaiAssesmen = $jumlahKomponenAssesmen > 0 ? round($totalNilaiAssesmen / $jumlahKomponenAssesmen, 2) : 0;
                    
                    // Ambil simpanan nilai
                    $simpanan = $simpananNilai->get($item->id_siswa);
                    
                    return [
                        'id_siswa' => $item->id_siswa,
                        'nama_siswa' => $item->nama,
                        'username' => $item->username,
                        'nilai_harian' => $nilaiHarianSiswa,
                        'rata_nilai_harian' => $rataNilaiHarian,
                        'nilai_assesmen' => $nilaiAssesmenSiswa,
                        'rata_nilai_assesmen' => $rataNilaiAssesmen,
                        'nilai_akhir' => $nilaiAkhir->get($item->id_siswa)->nilai ?? 0,
                        'simpanan_nilai' => $simpanan ? [
                            'id_simpanan_nilai' => $simpanan->id_simpanan_nilai,
                            'nilai' => $simpanan->nilai,
                            'terpakai_harian' => $simpanan->terpakai_harian,
                            'terpakai_assesmen' => $simpanan->terpakai_assesmen,
                            'max_pemakaian' => $simpanan->max_pemakaian,
                            'nilai_prioritas' => $simpanan->nilai_prioritas,
                        ] : null,
                    ];
                }),
        ];

        // return response()->json($data);
        return view($this->view.'.daftar', compact('data'));
    }

    //...
}


