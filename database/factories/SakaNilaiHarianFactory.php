<?php

namespace Database\Factories;

use App\Models\SakaNilaiHarian;
use Illuminate\Database\Eloquent\Factories\Factory;

class SakaNilaiHarianFactory extends Factory
{
    protected $model = SakaNilaiHarian::class;

    public function definition(): array
    {
        $nilai = rand(50, 100) + (rand(0, 99) / 100);

        return [
            'nilai' => number_format($nilai, 2, '.', ''),
            'id_tahun_ajaran' => null, // Will be set in seeder
            'simpanan_nilai_terpakai' => $this->faker->numberBetween(0, 30),
        ];
    }
}
