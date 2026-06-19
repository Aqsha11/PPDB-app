<?php

namespace Database\Factories;

use App\Models\Pendaftaran;
use Illuminate\Database\Eloquent\Factories\Factory;

class PendaftaranFactory extends Factory
{
    protected $model = Pendaftaran::class;

    public function definition(): array
    {
        $statuses = ['draft', 'submitted', 'verifikasi', 'diterima', 'cadangan', 'ditolak'];
        $status = $this->faker->randomElement($statuses);

        return [
            'nomor_pendaftaran' => 'PPDB-' . now()->year . '-' . str_pad($this->faker->unique()->numberBetween(1, 999), 3, '0', STR_PAD_LEFT),
            'status_pendaftaran' => $status,
            'tanggal_submit' => in_array($status, ['submitted', 'verifikasi', 'diterima', 'cadangan', 'ditolak'])
                ? $this->faker->dateTimeBetween('-2 months', '-1 week')
                : null,
        ];
    }

    public function submitted(): static
    {
        return $this->state(fn() => [
            'status_pendaftaran' => 'submitted',
            'tanggal_submit' => now()->subDays(rand(5, 20)),
        ]);
    }

    public function draft(): static
    {
        return $this->state(fn() => [
            'status_pendaftaran' => 'draft',
            'tanggal_submit' => null,
        ]);
    }
}
