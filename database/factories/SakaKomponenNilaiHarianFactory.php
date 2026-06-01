<?php

namespace Database\Factories;

use App\Models\SakaKomponenNilaiHarian;
use Illuminate\Database\Eloquent\Factories\Factory;

class SakaKomponenNilaiHarianFactory extends Factory
{
    protected $model = SakaKomponenNilaiHarian::class;

    public function definition(): array
    {
        $komponens = [
            'Kuis Harian',
            'Tugas Rumah (PR)',
            'Partisipasi Kelas',
            'Diskusi Kelas',
            'Presentasi',
            'Latihan Soal',
            'Lab Praktik',
            'Brainstorming',
        ];

        return [
            'kode_komponen_harian' => $this->faker->unique()->bothify('KNH###_K#######'),
            'nama_komponen' => $this->faker->randomElement($komponens),
            'kkm' => 75,
            'is_active' => 1,
            'id_tahun_ajaran' => null, // Will be set in seeder
        ];
    }
}
