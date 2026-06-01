<?php

namespace Database\Factories;

use App\Models\SakaKelas;
use Illuminate\Database\Eloquent\Factories\Factory;

class SakaKelasFactory extends Factory
{
    protected $model = SakaKelas::class;

    public function definition(): array
    {
        $tingkat = $this->faker->randomElement(['1', '2', '3']);
        $tingkatR = $this->faker->randomElement(['X', 'XI', 'XII']);
        $jurusan = $this->faker->randomElement(['RPL', 'TKJ', 'AKAPGD']);
        $nomor = $this->faker->numberBetween(1, 3);

        return [
            'kode_kelas' => strtoupper("{$tingkatR}_{$jurusan}_{$nomor}"),
            'nama_kelas' => "{$tingkatR} {$jurusan} {$nomor}",
            'tingkat' => $tingkat,
        ];
    }
}
