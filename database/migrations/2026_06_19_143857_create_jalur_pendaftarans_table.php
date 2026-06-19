<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jalur_pendaftarans', function (Blueprint $table) {

            $table->id();

            $table->string('nama');

            $table->string('slug')
                ->unique();

            $table->integer('kuota')
                ->default(0);

            $table->text('deskripsi')
                ->nullable();

            $table->boolean('status')
                ->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jalur_pendaftarans');
    }
};
