<?php

namespace Database\Factories;

use App\Models\SakaAdmin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class SakaAdminFactory extends Factory
{
    protected $model = SakaAdmin::class;

    public function definition(): array
    {
        return [
            'username' => $this->faker->unique()->username(),
            'password' => Hash::make('password123'),
            'nama' => $this->faker->name(),
        ];
    }
}
