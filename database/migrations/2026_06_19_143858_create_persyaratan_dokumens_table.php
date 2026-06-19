<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('persyaratan_dokumens', function (Blueprint $table) {

            $table->id();

            $table->foreignId('jalur_pendaftaran_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('nama');

            $table->string('slug')
                ->unique();

            $table->string('format')
                ->default('pdf,jpg,jpeg,png');

            $table->integer('max_size')
                ->default(2048);

            $table->boolean('is_wajib')
                ->default(true);

            $table->boolean('status')
                ->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('persyaratan_dokumens');
    }
};