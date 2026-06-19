<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('siswa_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('tahun_ajaran_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('periode_ppdb_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('jalur_pendaftaran_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('nomor_pendaftaran')
                ->unique();

            $table->enum('status_pendaftaran', [
                'draft',
                'submitted',
                'verifikasi',
                'diterima',
                'cadangan',
                'ditolak'
            ])->default('draft');

            $table->timestamp('tanggal_submit')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};