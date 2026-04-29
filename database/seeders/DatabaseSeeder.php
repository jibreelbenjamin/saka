<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\SakaAdmin;
use App\Models\SakaGuru;
use App\Models\SakaSiswa;
use App\Models\SakaKelas;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ============================================================
        // 1. Buat Data Kelas (untuk siswa)
        // ============================================================
        $kelas10 = SakaKelas::create([
            'nama_kelas' => 'X RPL 1',
            'tingkat' => '1',
        ]);

        $kelas11 = SakaKelas::create([
            'nama_kelas' => 'XI RPL 1',
            'tingkat' => '2',
        ]);

        $kelas12 = SakaKelas::create([
            'nama_kelas' => 'XII RPL 1',
            'tingkat' => '3',
        ]);

        // ============================================================
        // 2. Buat Akun Admin
        // ============================================================
        $admin = SakaAdmin::create([
            'username' => 'admin_saka',
            'password' => Hash::make('admin123'),
            'nama_admin' => 'Administrator Sistem',
        ]);

        // ============================================================
        // 3. Buat Akun Guru
        // ============================================================
        $guru = SakaGuru::create([
            'username' => 'guru_pai',
            'password' => Hash::make('guru123'),
            'nama_guru' => 'Dr. Hj. Siti Aminah, M.Pd',
        ]);

        // ============================================================
        // 4. Buat Akun Siswa
        // ============================================================
        $siswa = SakaSiswa::create([
            'id_kelas' => $kelas11->id_kelas,
            'username' => 'siswa_ahmad',
            'password' => Hash::make('siswa123'),
            'nama_lengkap' => 'Ahmad Fauzi',
            'kontak' => '081234567890',
            'alamat' => 'Jl. Merdeka No. 10, Jakarta',
        ]);

        // ============================================================
        // 5. Tampilkan Informasi di Console
        // ============================================================
        $this->command->info('===========================================');
        $this->command->info('✅ Seeder Berhasil Dijalankan!');
        $this->command->info('===========================================');
        $this->command->info('');
        $this->command->info('📋 AKUN LOGIN:');
        $this->command->info('');
        $this->command->info('👑 ADMIN:');
        $this->command->info('   Username: admin_saka');
        $this->command->info('   Password: admin123');
        $this->command->info('   Nama: Administrator Sistem');
        $this->command->info('');
        $this->command->info('👨‍🏫 GURU:');
        $this->command->info('   Username: guru_pai');
        $this->command->info('   Password: guru123');
        $this->command->info('   Nama: Dr. Hj. Siti Aminah, M.Pd');
        $this->command->info('');
        $this->command->info('👨‍🎓 SISWA:');
        $this->command->info('   Username: siswa_ahmad');
        $this->command->info('   Password: siswa123');
        $this->command->info('   Nama: Ahmad Fauzi');
        $this->command->info('   Kelas: ' . $kelas11->nama_kelas . ' (Tingkat ' . $kelas11->tingkat . ')');
        $this->command->info('');
        $this->command->info('===========================================');
    }
}