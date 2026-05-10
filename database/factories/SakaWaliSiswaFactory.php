<?php

namespace Database\Factories;

use App\Models\SakaWaliSiswa;
use Illuminate\Database\Eloquent\Factories\Factory;

class SakaWaliSiswaFactory extends Factory
{
    protected $model = SakaWaliSiswa::class;

    public function definition(): array
    {
        return [
            'nama_wali' => $this->faker->name(),
            'kontak' => $this->faker->phoneNumber(),
            'alamat' => $this->faker->address(),
            'status_wali' => $this->faker->randomElement(['Ayah', 'Ibu', 'Wali', 'Kakak']),
        ];
    }
}
