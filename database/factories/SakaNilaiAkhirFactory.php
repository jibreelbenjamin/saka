<?php

namespace Database\Factories;

use App\Models\SakaNilaiAkhir;
use Illuminate\Database\Eloquent\Factories\Factory;

class SakaNilaiAkhirFactory extends Factory
{
    protected $model = SakaNilaiAkhir::class;

    public function definition(): array
    {
        $nilai = rand(65, 100) + (rand(0, 99) / 100);

        return [
            'nilai' => number_format($nilai, 2, '.', ''),
            'id_tahun_ajaran' => null, // Will be set in seeder
        ];
    }
}
