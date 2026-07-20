<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('persyaratan_dokumens', function (Blueprint $table) {
            $table->string('kategori')->nullable()->after('keterangan');
            $table->integer('urutan')->default(0)->after('kategori');
        });
    }

    public function down(): void
    {
        Schema::table('persyaratan_dokumens', function (Blueprint $table) {
            $table->dropColumn(['kategori', 'urutan']);
        });
    }
};
