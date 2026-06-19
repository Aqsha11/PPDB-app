<?php

namespace Database\Factories;

use App\Models\OrangTua;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrangTuaFactory extends Factory
{
    protected $model = OrangTua::class;

    public function definition(): array
    {
        return [
            'nama_ayah' => $this->faker->firstNameMale() . ' ' . $this->faker->lastName(),
            'nik_ayah' => $this->faker->unique()->numerify('################'),
            'pekerjaan_ayah' => $this->faker->randomElement(['PNS', 'Swasta', 'Wiraswasta', 'Petani', 'Buruh', 'Guru', 'Dokter']),
            'nama_ibu' => $this->faker->firstNameFemale() . ' ' . $this->faker->lastName(),
            'nik_ibu' => $this->faker->unique()->numerify('################'),
            'pekerjaan_ibu' => $this->faker->randomElement(['Ibu Rumah Tangga', 'PNS', 'Swasta', 'Guru', 'Bidan', 'Wiraswasta']),
            'penghasilan' => $this->faker->randomElement([1000000, 2000000, 3000000, 5000000, 7500000, 10000000]),
            'no_hp' => '08' . $this->faker->numerify('##########'),
        ];
    }
}
