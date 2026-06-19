<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orang_tuas', function (Blueprint $table) {

            $table->id();

            $table->foreignId('siswa_id')
                ->unique()
                ->constrained()
                ->cascadeOnDelete();

            $table->string('nama_ayah');
            $table->string('nik_ayah', 20)->nullable();
            $table->string('pekerjaan_ayah')->nullable();

            $table->string('nama_ibu');
            $table->string('nik_ibu', 20)->nullable();
            $table->string('pekerjaan_ibu')->nullable();

            $table->decimal('penghasilan', 15, 2)
                ->nullable();

            $table->string('no_hp', 20);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orang_tuas');
    }
};