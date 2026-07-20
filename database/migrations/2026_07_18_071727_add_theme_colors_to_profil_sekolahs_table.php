<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profil_sekolahs', function (Blueprint $table) {
            $table->string('warna_primary')->nullable()->default('#2563EB')->after('email');
            $table->string('warna_second')->nullable()->default('#7C3AED')->after('warna_primary');
        });
    }

    public function down(): void
    {
        Schema::table('profil_sekolahs', function (Blueprint $table) {
            $table->dropColumn(['warna_primary', 'warna_second']);
        });
    }
};
