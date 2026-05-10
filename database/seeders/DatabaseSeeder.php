<?php

use Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\SakaAdmin;
use App\Models\SakaKelas;
use App\Models\SakaGuru;
use App\Models\SakaMapel;
use App\Models\SakaSiswa;
use App\Models\SakaTahunAjaran;
use App\Models\SakaAksesMapel;
use App\Models\SakaWaliSiswa;
use App\Models\SakaKomponenNilaiHarian;
use App\Models\SakaKomponenNilaiAssesmen;
use App\Models\SakaPengaturanNilaiAkhir;
use App\Models\SakaNilaiHarian;
use App\Models\SakaNilaiAssesmen;
use App\Models\SakaNilaiAkhir;
use App\Models\SakaSimpananNilai;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * ════════════════════════════════════════════════════════════
     * CONFIGURATION VARIABLES - CUSTOMIZE HERE!
     * ════════════════════════════════════════════════════════════
     */

    // User Configuration
    private int $numAdmin = 2;
    private int $numGuru = 5;
    private int $numSiswa = 500;

    // Class Configuration
    private array $tingkat = ['1', '2', '3'];
    private array $jurusan = ['RPL', 'TKJ'];
    private int $kelasPerJurusanPerTingkat = 1;
    private int $siswaPerKelas = 28;

    // Subject Configuration
    private int $numMapel = 12;

    // Tahun Ajaran Configuration
    private int $tahunMulai = 2024;
    private int $tahunAkhir = 2025;
    private array $semester = [1, 2];

    // Grading Configuration
    private int $komponenHarianPerMapel = 12;
    private int $komponenAssesmenPerMapel = 3;

    // Grade Value Ranges
    private array $nilaiHarianRange = [50, 100];
    private array $nilaiAssesmenRange = [20, 100];
    private array $nilaiAkhirRange = [20, 100];

    // Simpanan Nilai Configuration
    private bool $createSimpananNilai = true;

    // Runtime Variables
    private array $tahunAjaranIds = [];
    private int $defaultTahunAjaranId; // FIX: tambahkan properti untuk default tahun ajaran

    /**
     * ════════════════════════════════════════════════════════════
     * RUN SEEDER
     * ════════════════════════════════════════════════════════════
     */
    public function run(): void
    {
        $this->displayHeader();
        $this->displayConfiguration();

        // Create base data using factories
        $this->createAdmins();
        $this->createTahunAjaran();     // <-- sekarang mengisi $defaultTahunAjaranId
        $this->createKelas();
        $this->createGuru();
        $this->createMapel();
        $this->createSiswa();

        // Create relationships
        $this->createAksesMapel();
        $this->createWaliSiswa();

        // Create grading components
        $this->createKomponenNilaiHarian();
        $this->createKomponenNilaiAssesmen();
        $this->createPengaturanNilaiAkhir();

        // Create grades
        $this->createNilaiHarian();
        $this->createNilaiAssesmen();
        $this->createNilaiAkhir();

        // Create simpanan nilai
        if ($this->createSimpananNilai) {
            $this->createSimpananNilai();
        }

        $this->displaySummary();

        SakaAdmin::create([
            'username' => 'admin_saka',
            'password' => Hash::make('admin123'),
            'nama' => 'Administrator Sistem',
        ]);

        SakaGuru::create([
            'username' => 'guru_saka',
            'password' => Hash::make('guru123'),
            'nama' => 'Pak Arman',
        ]);
    }

    /**
     * ════════════════════════════════════════════════════════════
     * FACTORY-BASED CREATION METHODS
     * ════════════════════════════════════════════════════════════
     */

    private function createAdmins(): void
    {
        $this->command->info('🔐 Creating Admins...');
        SakaAdmin::factory($this->numAdmin)->create();
        $this->command->info("   ✓ {$this->numAdmin} admin(s) created");
    }

    private function createTahunAjaran(): void
    {
        $this->command->info('📅 Creating Tahun Ajaran...');
        $count = 0;
        foreach ($this->semester as $semester) {
            $tahunAjaran = SakaTahunAjaran::create([
                'tahun_mulai' => $this->tahunMulai,
                'tahun_akhir' => $this->tahunAkhir,
                'semester'    => $semester,
            ]);
            $this->tahunAjaranIds[] = $tahunAjaran->id_tahun_ajaran;
            $count++;
        }
        // FIX: set default tahun ajaran (gunakan yang pertama)
        $this->defaultTahunAjaranId = $this->tahunAjaranIds[0];
        $this->command->info("   ✓ {$count} tahun ajaran created (default ID: {$this->defaultTahunAjaranId})");
    }

    private function createKelas(): void
    {
        $this->command->info('📚 Creating Kelas...');
        $count = 0;

        foreach ($this->tingkat as $tingkat) {
            foreach ($this->jurusan as $jurusan) {
                for ($i = 1; $i <= $this->kelasPerJurusanPerTingkat; $i++) {
                    SakaKelas::factory()->create([
                        'kode_kelas' => "{$tingkat}_{$jurusan}_{$i}",
                        'nama_kelas' => "{$tingkat} {$jurusan} {$i}",
                        'tingkat' => $tingkat,
                    ]);
                    $count++;
                }
            }
        }

        $this->command->info("   ✓ {$count} kelas created");
    }

    private function createGuru(): void
    {
        $this->command->info('👨‍🏫 Creating Guru...');
        SakaGuru::factory($this->numGuru)->create();
        $this->command->info("   ✓ {$this->numGuru} guru created");
    }

    private function createMapel(): void
    {
        $this->command->info('📖 Creating Mapel...');

        $mapels = [
            ['MATH', 'Matematika'],
            ['INDO', 'Bahasa Indonesia'],
            ['ENG', 'Bahasa Inggris'],
            ['BIO', 'Biologi'],
            ['CHEM', 'Kimia'],
            ['PHY', 'Fisika'],
            ['PROGDASAR', 'Dasar Pemrograman'],
            ['WEBDEV', 'Web Development'],
            ['DBMS', 'Database Management System'],
            ['OOPROG', 'Pemrograman Berorientasi Objek'],
            ['JARINGAN', 'Jaringan Dasar'],
            ['ADMIN', 'Administrasi Server'],
            ['SECURITY', 'Keamanan Jaringan'],
        ];

        $count = 0;
        foreach (array_slice($mapels, 0, $this->numMapel) as $mapel) {
            SakaMapel::create([
                'kode_mapel' => $mapel[0],
                'nama_mapel' => $mapel[1],
            ]);
            $count++;
        }

        $this->command->info("   ✓ {$count} mapel created");
    }

    private function createSiswa(): void
    {
        $this->command->info('👨‍🎓 Creating Siswa...');
        $kelas = SakaKelas::all();
        $count = 0;

        foreach ($kelas as $k) {
            for ($i = 0; $i < $this->siswaPerKelas; $i++) {
                SakaSiswa::factory()->create([
                    'id_kelas' => $k->id_kelas,
                ]);
                $count++;
            }
        }

        $this->command->info("   ✓ {$count} siswa created ({$this->siswaPerKelas} per kelas)");
    }

    private function createAksesMapel(): void
    {
        $this->command->info('🔗 Creating Akses Mapel...');
        $gurus = SakaGuru::all();
        $mapels = SakaMapel::all();
        $kelas = SakaKelas::all();
        $count = 0;

        foreach ($gurus as $guru) {
            $numMapelPerGuru = rand(2, 4);
            $selectedMapels = $mapels->random($numMapelPerGuru);

            foreach ($selectedMapels as $mapel) {
                $numKelasPerGuroMapel = rand(1, 2);
                $selectedKelas = $kelas->random($numKelasPerGuroMapel);

                foreach ($selectedKelas as $kelasItem) {
                    $exists = SakaAksesMapel::where('id_guru', $guru->id_guru)
                        ->where('id_mapel', $mapel->id_mapel)
                        ->where('id_kelas', $kelasItem->id_kelas)
                        ->exists();

                    if (!$exists) {
                        SakaAksesMapel::create([
                            'id_guru' => $guru->id_guru,
                            'id_mapel' => $mapel->id_mapel,
                            'id_kelas' => $kelasItem->id_kelas,
                        ]);
                        $count++;
                    }
                }
            }
        }

        $this->command->info("   ✓ {$count} akses mapel created");
    }

    private function createWaliSiswa(): void
    {
        $this->command->info('👨‍👩‍👧 Creating Wali Siswa...');
        $siswas = SakaSiswa::all();
        $count = 0;

        foreach ($siswas as $siswa) {
            SakaWaliSiswa::factory()->create([
                'id_siswa' => $siswa->id_siswa,
            ]);
            $count++;
        }

        $this->command->info("   ✓ {$count} wali siswa created");
    }

    private function createKomponenNilaiHarian(): void
    {
        $this->command->info('📝 Creating Komponen Nilai Harian...');
        $gurus = SakaGuru::all();
        $mapels = SakaMapel::all();
        $count = 0;

        foreach ($gurus as $guru) {
            foreach ($mapels as $mapel) {
                for ($i = 0; $i < $this->komponenHarianPerMapel; $i++) {
                    SakaKomponenNilaiHarian::factory()->create([
                        'id_guru' => $guru->id_guru,
                        'id_mapel' => $mapel->id_mapel,
                        'id_tahun_ajaran' => $this->defaultTahunAjaranId, // FIX: tambah id_tahun_ajaran
                    ]);
                    $count++;
                }
            }
        }

        $this->command->info("   ✓ {$count} komponen nilai harian created");
    }

    private function createKomponenNilaiAssesmen(): void
    {
        $this->command->info('✅ Creating Komponen Nilai Assesmen...');
        $gurus = SakaGuru::all();
        $mapels = SakaMapel::all();
        $count = 0;

        foreach ($gurus as $guru) {
            foreach ($mapels as $mapel) {
                for ($i = 0; $i < $this->komponenAssesmenPerMapel; $i++) {
                    SakaKomponenNilaiAssesmen::factory()->create([
                        'id_guru' => $guru->id_guru,
                        'id_mapel' => $mapel->id_mapel,
                        'id_tahun_ajaran' => $this->defaultTahunAjaranId, // FIX: tambah id_tahun_ajaran
                    ]);
                    $count++;
                }
            }
        }

        $this->command->info("   ✓ {$count} komponen nilai assesmen created");
    }

    private function createPengaturanNilaiAkhir(): void
    {
        $this->command->info('⚙️  Creating Pengaturan Nilai Akhir...');
        $gurus = SakaGuru::all();
        $mapels = SakaMapel::all();
        $count = 0;

        foreach ($gurus as $guru) {
            foreach ($mapels as $mapel) {
                $exists = SakaPengaturanNilaiAkhir::where('id_guru', $guru->id_guru)
                    ->where('id_mapel', $mapel->id_mapel)
                    ->exists();

                if (!$exists) {
                    $presHarian = rand(30, 70);
                    $presAssesmen = 100 - $presHarian;

                    SakaPengaturanNilaiAkhir::create([
                        'id_guru' => $guru->id_guru,
                        'id_mapel' => $mapel->id_mapel,
                        'id_tahun_ajaran' => $this->defaultTahunAjaranId, // FIX: tambah id_tahun_ajaran
                        'pres_nilai_harian' => $presHarian,
                        'pres_nilai_assesmen' => $presAssesmen,
                        'kkm' => 75,
                    ]);
                    $count++;
                }
            }
        }

        $this->command->info("   ✓ {$count} pengaturan nilai akhir created");
    }

    private function createNilaiHarian(): void
    {
        $this->command->info('📊 Creating Nilai Harian...');
        $komponens = SakaKomponenNilaiHarian::all();
        $siswas = SakaSiswa::all();
        $count = 0;

        foreach ($komponens as $komponen) {
            foreach ($siswas as $siswa) {
                $exists = SakaNilaiHarian::where('id_komponen_nilai_harian', $komponen->id_komponen_nilai_harian)
                    ->where('id_siswa', $siswa->id_siswa)
                    ->exists();

                if (!$exists) {
                    SakaNilaiHarian::factory()->create([
                        'id_komponen_nilai_harian' => $komponen->id_komponen_nilai_harian,
                        'id_siswa' => $siswa->id_siswa,
                        'id_tahun_ajaran' => $this->defaultTahunAjaranId, // FIX: tambah id_tahun_ajaran
                    ]);
                    $count++;
                }
            }
        }

        $this->command->info("   ✓ {$count} nilai harian created");
    }

    private function createNilaiAssesmen(): void
    {
        $this->command->info('🎯 Creating Nilai Assesmen...');
        $komponens = SakaKomponenNilaiAssesmen::all();
        $siswas = SakaSiswa::all();
        $count = 0;

        foreach ($komponens as $komponen) {
            foreach ($siswas as $siswa) {
                $exists = SakaNilaiAssesmen::where('id_komponen_nilai_assesmen', $komponen->id_komponen_nilai_assesmen)
                    ->where('id_siswa', $siswa->id_siswa)
                    ->exists();

                if (!$exists) {
                    SakaNilaiAssesmen::factory()->create([
                        'id_komponen_nilai_assesmen' => $komponen->id_komponen_nilai_assesmen,
                        'id_siswa' => $siswa->id_siswa,
                        'id_tahun_ajaran' => $this->defaultTahunAjaranId, // FIX: tambah id_tahun_ajaran
                    ]);
                    $count++;
                }
            }
        }

        $this->command->info("   ✓ {$count} nilai assesmen created");
    }

    private function createNilaiAkhir(): void
    {
        $this->command->info('🏆 Creating Nilai Akhir (Calculated)...');
        $mapels = SakaMapel::all();
        $siswas = SakaSiswa::all();
        $count = 0;

        foreach ($mapels as $mapel) {
            foreach ($siswas as $siswa) {
                $exists = SakaNilaiAkhir::where('id_mapel', $mapel->id_mapel)
                    ->where('id_siswa', $siswa->id_siswa)
                    ->exists();

                if (!$exists) {
                    // Calculate average grades
                    $nilaiHarianAvg = SakaNilaiHarian::whereHas('komponenNilaiHarian', function ($q) use ($mapel) {
                        $q->where('id_mapel', $mapel->id_mapel);
                    })->where('id_siswa', $siswa->id_siswa)->avg('nilai') ?? 75;

                    $nilaiAssesmenAvg = SakaNilaiAssesmen::whereHas('komponenNilaiAssesmen', function ($q) use ($mapel) {
                        $q->where('id_mapel', $mapel->id_mapel);
                    })->where('id_siswa', $siswa->id_siswa)->avg('nilai') ?? 75;

                    // Get weighting settings
                    $pengaturan = SakaPengaturanNilaiAkhir::where('id_mapel', $mapel->id_mapel)->first();

                    if ($pengaturan) {
                        $presHarian = $pengaturan->pres_nilai_harian / 100;
                        $presAssesmen = $pengaturan->pres_nilai_assesmen / 100;
                    } else {
                        $presHarian = 0.6;
                        $presAssesmen = 0.4;
                    }

                    // Calculate final grade
                    $nilaiAkhir = ($nilaiHarianAvg * $presHarian) + ($nilaiAssesmenAvg * $presAssesmen);

                    SakaNilaiAkhir::create([
                        'id_mapel' => $mapel->id_mapel,
                        'id_siswa' => $siswa->id_siswa,
                        'id_tahun_ajaran' => $this->defaultTahunAjaranId, // FIX: tambah id_tahun_ajaran
                        'nilai' => number_format($nilaiAkhir, 2, '.', ''),
                    ]);
                    $count++;
                }
            }
        }

        $this->command->info("   ✓ {$count} nilai akhir created");
    }

    private function createSimpananNilai(): void
    {
        $this->command->info('🏦 Creating Simpanan Nilai...');
        $gurus = SakaGuru::all();
        $mapels = SakaMapel::all();
        $siswas = SakaSiswa::all();
        $count = 0;

        foreach ($gurus as $guru) {
            foreach ($mapels as $mapel) {
                foreach ($siswas as $siswa) {
                    // Check if simpanan nilai already exists for this guru-mapel-siswa
                    $exists = SakaSimpananNilai::where('id_guru', $guru->id_guru)
                        ->where('id_mapel', $mapel->id_mapel)
                        ->where('id_siswa', $siswa->id_siswa)
                        ->exists();

                    if (!$exists) {
                        SakaSimpananNilai::factory()->create([
                            'id_guru' => $guru->id_guru,
                            'id_mapel' => $mapel->id_mapel,
                            'id_siswa' => $siswa->id_siswa,
                            'id_tahun_ajaran' => $this->defaultTahunAjaranId, // FIX: tambah id_tahun_ajaran
                        ]);
                        $count++;
                    }
                }
            }
        }

        $this->command->info("   ✓ {$count} simpanan nilai created");
    }

    /**
     * ════════════════════════════════════════════════════════════
     * DISPLAY METHODS
     * ════════════════════════════════════════════════════════════
     */

    private function displayHeader(): void
    {
        $this->command->info('');
        $this->command->info('╔════════════════════════════════════════════════╗');
        $this->command->info('║   🚀 SAKA Database Seeding - Dimulai           ║');
        $this->command->info('╚════════════════════════════════════════════════╝');
        $this->command->info('');
    }

    private function displayConfiguration(): void
    {
        $this->command->info('⚙️  CONFIGURATION:');
        $this->command->info("   • Admin: {$this->numAdmin}");
        $this->command->info("   • Guru: {$this->numGuru}");
        $this->command->info("   • Siswa per Kelas: {$this->siswaPerKelas}");
        $this->command->info("   • Mapel: {$this->numMapel}");
        $this->command->info("   • Komponen Harian per Mapel: {$this->komponenHarianPerMapel}");
        $this->command->info("   • Komponen Assesmen per Mapel: {$this->komponenAssesmenPerMapel}");
        $this->command->info('');
    }

    private function displaySummary(): void
    {
        $this->command->info('');
        $this->command->info('╔════════════════════════════════════════════════╗');
        $this->command->info('║   ✅ Seeder Berhasil Dijalankan!               ║');
        $this->command->info('╚════════════════════════════════════════════════╝');
        $this->command->info('');
        $this->command->info('📊 DATA YANG DIBUAT:');
        $this->command->info("   • {$this->numAdmin} Admin accounts");
        $this->command->info("   • " . (count($this->tingkat) * count($this->jurusan) * $this->kelasPerJurusanPerTingkat) . " Kelas");
        $this->command->info("   • {$this->numGuru} Guru pengajar");
        $this->command->info("   • {$this->numMapel} Mata Pelajaran");
        $this->command->info("   • " . (count($this->tingkat) * count($this->jurusan) * $this->kelasPerJurusanPerTingkat * $this->siswaPerKelas) . " Siswa ({$this->siswaPerKelas} per kelas)");
        $this->command->info("   • Akses Mapel dengan random Guru-Kelas");
        $this->command->info("   • Komponen Nilai (Harian & Assesmen)");
        $this->command->info("   • Pengaturan Nilai Akhir");
        $this->command->info("   • Nilai Harian, Assesmen & Nilai Akhir");
        $this->command->info("   • Data Wali Siswa");
        if ($this->createSimpananNilai) {
            $this->command->info("   • Simpanan Nilai (untuk Guru-Mapel-Siswa)");
        }
        $this->command->info('');
        $this->command->info('═══════════════════════════════════════════════════');
        $this->command->info('💡 TIP: Edit configuration di DatabaseSeeder.php');
        $this->command->info('═══════════════════════════════════════════════════');
    }
}