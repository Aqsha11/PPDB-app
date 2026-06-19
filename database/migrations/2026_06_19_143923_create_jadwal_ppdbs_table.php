<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_ppdbs', function (Blueprint $table) {

            $table->id();

            $table->string('kegiatan');

            $table->date('tanggal_mulai');

            $table->date('tanggal_selesai')
                ->nullable();

            $table->text('deskripsi')
                ->nullable();

            $table->integer('urutan')
                ->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_ppdbs');
    }
};