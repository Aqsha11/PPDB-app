<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('footers', function (Blueprint $table) {
            $table->string('alamat')->nullable()->after('deskripsi');
            $table->string('email')->nullable()->after('alamat');
            $table->string('telepon')->nullable()->after('email');
            $table->string('logo')->nullable()->after('telepon');
        });
    }

    public function down(): void
    {
        Schema::table('footers', function (Blueprint $table) {
            $table->dropColumn(['alamat', 'email', 'telepon', 'logo']);
        });
    }
};
