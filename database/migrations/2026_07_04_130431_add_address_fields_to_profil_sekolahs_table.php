<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profil_sekolahs', function (Blueprint $table) {
            $table->string('npsn')->nullable()->after('nama_sekolah');
            $table->string('alamat')->nullable()->after('sejarah');
            $table->string('kelurahan')->nullable()->after('alamat');
            $table->string('kecamatan')->nullable()->after('kelurahan');
            $table->string('kota')->nullable()->after('kecamatan');
            $table->string('provinsi')->nullable()->after('kota');
            $table->string('kode_pos')->nullable()->after('provinsi');
            $table->string('telepon')->nullable()->after('kode_pos');
            $table->string('email')->nullable()->after('telepon');
        });
    }

    public function down(): void
    {
        Schema::table('profil_sekolahs', function (Blueprint $table) {
            $table->dropColumn(['npsn', 'alamat', 'kelurahan', 'kecamatan', 'kota', 'provinsi', 'kode_pos', 'telepon', 'email']);
        });
    }
};
