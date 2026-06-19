<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daftar_ulangs', function (Blueprint $table) {

            $table->id();

            $table->foreignId('pendaftaran_id')
                ->unique()
                ->constrained()
                ->cascadeOnDelete();

            $table->enum('status', [
                'belum',
                'sudah'
            ])->default('belum');

            $table->timestamp('tanggal_daftar_ulang')
                ->nullable();

            $table->text('catatan')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daftar_ulangs');
    }
};