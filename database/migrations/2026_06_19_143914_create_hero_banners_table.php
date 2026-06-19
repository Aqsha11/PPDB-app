<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hero_banners', function (Blueprint $table) {

            $table->id();

            $table->string('judul');
            $table->string('sub_judul')->nullable();

            $table->text('deskripsi')->nullable();

            $table->string('gambar');

            $table->string('button_text')->nullable();
            $table->string('button_link')->nullable();

            $table->integer('urutan')->default(0);

            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_banners');
    }
};