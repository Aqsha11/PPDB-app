<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('statistik_sekolahs', function (Blueprint $table) {

            $table->id();

            $table->string('judul');

            $table->bigInteger('jumlah')
                ->default(0);

            $table->string('icon')
                ->nullable();

            $table->integer('urutan')
                ->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('statistik_sekolahs');
    }
};