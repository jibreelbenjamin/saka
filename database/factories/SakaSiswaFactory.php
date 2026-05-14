<?php

namespace Database\Factories;

use App\Models\SakaSiswa;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class SakaSiswaFactory extends Factory
{
    protected $model = SakaSiswa::class;

    public function definition(): array
    {
        return [
            'username' => $this->faker->unique()->bothify('#####/####.###'),
            'password' => Hash::make('password123'),
            'nama' => $this->faker->name(),
            'kontak' => $this->faker->phoneNumber(),
            'alamat' => $this->faker->address(),
            'status' => 'aktif',
            'tahun_lulus' => null,
        ];
    }
}
