<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dokumen_pendaftarans', function (Blueprint $table) {

            $table->id();

            $table->foreignId('pendaftaran_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('persyaratan_dokumen_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('file');

            $table->enum('status', [
                'pending',
                'revisi',
                'terverifikasi'
            ])->default('pending');

            $table->text('catatan')
                ->nullable();

            $table->timestamp('verified_at')
                ->nullable();

            $table->timestamps();

            $table->unique([
                'pendaftaran_id',
                'persyaratan_dokumen_id'
            ], 'dp_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokumen_pendaftarans');
    }
};
