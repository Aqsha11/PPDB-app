<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class CleanDummyData extends Command
{
    protected $signature = 'app:clean-dummy-data {--force : Skip confirmation}';

    protected $description = 'Delete all dummy data (peserta, pendaftaran, tahun ajaran, CMS content) but keep admin users, roles, permissions, and profil sekolah';

    public function handle(): int
    {
        if (!$this->option('force') && !$this->confirm('This will delete ALL peserta, pendaftaran, and CMS content data. Admin users will be preserved. Continue?')) {
            return self::SUCCESS;
        }

        DB::beginTransaction();

        try {
            $tables = [
                'daftar_ulangs',
                'hasil_seleksis',
                'verifikasi_pendaftarans',
                'dokumen_pendaftarans',
                'pendaftarans',
                'sekolah_asals',
                'orang_tuas',
                'pesertas',
                'jalur_pendaftarans',
                'persyaratan_dokumens',
                'periode_ppdbs',
                'tahun_ajarans',
                'beritas',
                'faqs',
                'jadwal_ppdbs',
                'tahapan_ppdbs',
                'keunggulan_sekolahs',
                'statistik_sekolahs',
                'sambutan_kepala_sekolahs',
                'hero_banners',
                'pengumumans',
                'galeris',
                'videos',
                'testimonis',
                'partners',
                'media_sosials',
                'kontaks',
                'footers',
                'seos',
                'activity_log',
            ];

            foreach ($tables as $table) {
                if (DB::getSchemaBuilder()->hasTable($table)) {
                    DB::table($table)->truncate();
                }
            }

            $pesertaRoleIds = DB::table('roles')->whereIn('name', ['Peserta'])->pluck('id');
            $pesertaUserIds = DB::table('model_has_roles')->whereIn('role_id', $pesertaRoleIds)->pluck('model_id');
            DB::table('model_has_roles')->whereIn('model_id', $pesertaUserIds)->delete();
            User::whereIn('id', $pesertaUserIds)->delete();

            DB::commit();

            $this->info('All dummy data has been deleted. Admin users, roles, permissions, and profil sekolah are preserved.');

            return self::SUCCESS;
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->error('Failed: ' . $e->getMessage());
            return self::FAILURE;
        }
    }
}
