<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hasil_seleksis', function (Blueprint $table) {

            $table->id();

            $table->foreignId('pendaftaran_id')
                ->unique()
                ->constrained()
                ->cascadeOnDelete();

            $table->decimal('nilai', 8, 2)
                ->nullable();

            $table->integer('peringkat')
                ->nullable();

            $table->enum('status', [
                'diterima',
                'cadangan',
                'tidak_diterima'
            ]);

            $table->text('keterangan')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hasil_seleksis');
    }
};