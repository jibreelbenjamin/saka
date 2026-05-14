<?php

namespace Database\Factories;

use App\Models\SakaKomponenNilaiAssesmen;
use Illuminate\Database\Eloquent\Factories\Factory;

class SakaKomponenNilaiAssesmenFactory extends Factory
{
    protected $model = SakaKomponenNilaiAssesmen::class;

    public function definition(): array
    {
        $komponens = [
            'UH',
            'UTS',
            'UAS',
            'Tes Praktik',
            'Quiz',
            'PKK',
            'P5',
            'TA'
        ];

        return [
            'kode_komponen_assesmen' => $this->faker->unique()->bothify('KNA###_K#######'),
            'nama_komponen' => $this->faker->randomElement($komponens),
            'kkm' => 75,
            'is_active' => 1,
            'id_tahun_ajaran' => null, // Will be set in seeder
        ];
    }
}
