<?php

namespace Database\Factories;

use App\Models\SakaGuru;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class SakaGuruFactory extends Factory
{
    protected $model = SakaGuru::class;

    public function definition(): array
    {
        return [
            'username' => $this->faker->unique()->username(),
            'password' => Hash::make('password123'),
            'nama' => $this->faker->name() . ', S.Pd',
        ];
    }
}
