<?php

namespace Database\Factories;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiswaFactory extends Factory
{
    protected $model = Siswa::class;

    public function definition(): array
    {
        $jenisKelamin = $this->faker->randomElement(['L', 'P']);
        $namaLengkap = $jenisKelamin === 'L'
            ? $this->faker->firstNameMale() . ' ' . $this->faker->lastName()
            : $this->faker->firstNameFemale() . ' ' . $this->faker->lastName();

        return [
            'nisn' => $this->faker->unique()->numerify('##########'),
            'nik' => $this->faker->unique()->numerify('################'),
            'nama_lengkap' => $namaLengkap,
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->dateTimeBetween('-15 years', '-11 years')->format('Y-m-d'),
            'jenis_kelamin' => $jenisKelamin,
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
            'alamat' => $this->faker->streetAddress(),
            'provinsi' => 'Jawa Barat',
            'kabupaten' => $this->faker->randomElement(['Bandung', 'Bandung Barat', 'Cimahi', 'Sumedang']),
            'kecamatan' => $this->faker->streetName(),
            'kelurahan' => $this->faker->streetSuffix(),
            'kode_pos' => $this->faker->postcode(),
        ];
    }
}
