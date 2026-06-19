<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sambutan_kepala_sekolahs', function (Blueprint $table) {

            $table->id();

            $table->string('nama');

            $table->string('jabatan')
                ->default('Kepala Sekolah');

            $table->string('foto')
                ->nullable();

            $table->longText('isi');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sambutan_kepala_sekolahs');
    }
};