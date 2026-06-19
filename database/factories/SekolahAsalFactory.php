<?php

namespace Database\Factories;

use App\Models\SekolahAsal;
use Illuminate\Database\Eloquent\Factories\Factory;

class SekolahAsalFactory extends Factory
{
    protected $model = SekolahAsal::class;

    public function definition(): array
    {
        return [
            'nama_sekolah' => $this->faker->randomElement([
                'SDN Citarum',
                'SDN Majalaya',
                'SDN Babakan',
                'SDIT Al-Fath',
                'SD Mutiara Bunda',
                'SDN Sukamenak',
                'SDIT Bina Insan',
                'SD Kristen Kalam Kudus',
            ]),
            'npsn' => $this->faker->unique()->numerify('#########'),
            'alamat' => $this->faker->streetAddress(),
            'tahun_lulus' => $this->faker->numberBetween(2023, 2025),
        ];
    }
}
