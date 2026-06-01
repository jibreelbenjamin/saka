<?php

namespace Database\Factories;

use App\Models\SakaMapel;
use Illuminate\Database\Eloquent\Factories\Factory;

class SakaMapelFactory extends Factory
{
    protected $model = SakaMapel::class;

    public function definition(): array
    {
        $mapels = [
            ['MATH', 'Matematika'],
            ['INDO', 'Bahasa Indonesia'],
            ['ENG', 'Bahasa Inggris'],
            ['BIO', 'Biologi'],
            ['CHEM', 'Kimia'],
            ['PHY', 'Fisika'],
            ['PROGDASAR', 'Dasar Pemrograman'],
            ['WEBDEV', 'Web Development'],
            ['DBMS', 'Database Management System'],
            ['OOPROG', 'Pemrograman Berorientasi Objek'],
            ['JARINGAN', 'Jaringan Dasar'],
            ['ADMIN', 'Administrasi Server'],
            ['SECURITY', 'Keamanan Jaringan'],
        ];

        $mapel = $this->faker->randomElement($mapels);

        return [
            'kode_mapel' => $mapel[0],
            'nama_mapel' => $mapel[1],
        ];
    }
}
