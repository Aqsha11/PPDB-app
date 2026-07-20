<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::rename('siswas', 'pesertas');

        Schema::table('orang_tuas', function (Blueprint $table) {
            $table->renameColumn('siswa_id', 'peserta_id');
        });

        Schema::table('sekolah_asals', function (Blueprint $table) {
            $table->renameColumn('siswa_id', 'peserta_id');
        });

        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->renameColumn('siswa_id', 'peserta_id');
        });
    }

    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->renameColumn('peserta_id', 'siswa_id');
        });

        Schema::table('sekolah_asals', function (Blueprint $table) {
            $table->renameColumn('peserta_id', 'siswa_id');
        });

        Schema::table('orang_tuas', function (Blueprint $table) {
            $table->renameColumn('peserta_id', 'siswa_id');
        });

        Schema::rename('pesertas', 'siswas');
    }
};
