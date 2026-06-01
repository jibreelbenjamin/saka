<?php

namespace Database\Factories;

use App\Models\SakaTahunAjaran;
use Illuminate\Database\Eloquent\Factories\Factory;

class SakaTahunAjaranFactory extends Factory
{
    protected $model = SakaTahunAjaran::class;

    public function definition(): array
    {
        $tahunMulai = $this->faker->year();
        $tahunAkhir = $tahunMulai + 1;

        return [
            'tahun_mulai' => $tahunMulai,
            'tahun_akhir' => $tahunAkhir,
            'semester' => $this->faker->randomElement([1, 2]),
            'is_active' => false,
        ];
    }

    public function active(): self
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }

    public function semester(int $semester): self
    {
        return $this->state(fn (array $attributes) => [
            'semester' => $semester,
        ]);
    }
}
