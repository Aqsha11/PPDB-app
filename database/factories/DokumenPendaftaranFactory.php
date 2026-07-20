<?php

namespace Database\Factories;

use App\Models\DokumenPendaftaran;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

class DokumenPendaftaranFactory extends Factory
{
    protected $model = DokumenPendaftaran::class;

    public function definition(): array
    {
        $filename = 'dokumen/sample-' . $this->faker->uuid() . '.pdf';

        Storage::disk('public')->put($filename, 'Dummy PDF content for ' . basename($filename));

        return [
            'file' => $filename,
            'status' => $this->faker->randomElement(['pending', 'terverifikasi', 'revisi']),
            'catatan' => null,
            'verified_at' => null,
        ];
    }
}
