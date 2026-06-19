<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('verifikasi_pendaftarans', function (Blueprint $table) {

            $table->id();

            $table->foreignId('pendaftaran_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('verifikator_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->enum('status', [
                'pending',
                'revisi',
                'terverifikasi'
            ]);

            $table->text('catatan')
                ->nullable();

            $table->timestamp('tanggal_verifikasi')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('verifikasi_pendaftarans');
    }
};