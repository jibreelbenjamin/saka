<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SakaSimpananNilaiFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nilai' => $this->faker->randomFloat(2, 0, 200),
            'terpakai_harian' => $this->faker->randomFloat(2, 0, 120),
            'terpakai_assesmen' => $this->faker->randomFloat(2, 0, 50),
            'id_tahun_ajaran' => null, // Will be set in seeder
        ];
    }
}
