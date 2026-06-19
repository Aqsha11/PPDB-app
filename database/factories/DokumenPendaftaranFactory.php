<?php

namespace Database\Factories;

use App\Models\DokumenPendaftaran;
use Illuminate\Database\Eloquent\Factories\Factory;

class DokumenPendaftaranFactory extends Factory
{
    protected $model = DokumenPendaftaran::class;

    public function definition(): array
    {
        return [
            'file' => 'dokumen/sample-' . $this->faker->uuid() . '.pdf',
            'status' => $this->faker->randomElement(['pending', 'terverifikasi', 'revisi']),
            'catatan' => null,
            'verified_at' => null,
        ];
    }
}
