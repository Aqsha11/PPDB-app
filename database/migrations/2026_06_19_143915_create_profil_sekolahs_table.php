<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profil_sekolahs', function (Blueprint $table) {

            $table->id();

            $table->string('nama_sekolah');

            $table->string('logo')->nullable();

            $table->longText('visi')->nullable();

            $table->longText('misi')->nullable();

            $table->longText('sejarah')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profil_sekolahs');
    }
};