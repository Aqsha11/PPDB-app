<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('form_daftar_ulang_data');
        Schema::dropIfExists('form_daftar_ulang_fields');

        Schema::table('daftar_ulangs', function (Blueprint $table) {
            $table->string('bukti_kelulusan')->nullable()->after('catatan');
            $table->string('fotokopi_kk')->nullable()->after('bukti_kelulusan');
            $table->string('akta_kelahiran')->nullable()->after('fotokopi_kk');
            $table->string('ktp_orang_tua')->nullable()->after('akta_kelahiran');
            $table->string('skl_ijazah')->nullable()->after('ktp_orang_tua');
        });
    }

    public function down(): void
    {
        Schema::table('daftar_ulangs', function (Blueprint $table) {
            $table->dropColumn([
                'bukti_kelulusan',
                'fotokopi_kk',
                'akta_kelahiran',
                'ktp_orang_tua',
                'skl_ijazah',
            ]);
        });

        Schema::create('form_daftar_ulang_fields', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->enum('type', ['text', 'textarea', 'number', 'date', 'select', 'file']);
            $table->json('options')->nullable();
            $table->boolean('is_required')->default(false);
            $table->integer('urutan')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('form_daftar_ulang_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained()->cascadeOnDelete();
            $table->foreignId('form_daftar_ulang_field_id')->constrained()->cascadeOnDelete();
            $table->text('value')->nullable();
            $table->timestamps();
            $table->unique(['pendaftaran_id', 'form_daftar_ulang_field_id'], 'fdu_pend_field_unique');
        });
    }
};
