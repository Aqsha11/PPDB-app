<?php

namespace Database\Seeders;

use App\Models\Berita;
use App\Models\DaftarUlang;
use App\Models\DokumenPendaftaran;
use App\Models\Faq;
use App\Models\Galeri;
use App\Models\HasilSeleksi;
use App\Models\HeroBanner;
use App\Models\JadwalPpdb;
use App\Models\JalurPendaftaran;
use App\Models\KeunggulanSekolah;
use App\Models\Kontak;
use App\Models\Pendaftaran;
use App\Models\Pengumuman;
use App\Models\PeriodePpdb;
use App\Models\PersyaratanDokumen;
use App\Models\Peserta;
use App\Models\SambutanKepalaSekolah;
use App\Models\Seo;
use App\Models\StatistikSekolah;
use App\Models\TahunAjaran;
use App\Models\TahapanPpdb;
use App\Models\Testimoni;
use App\Models\User;
use App\Models\VerifikasiPendaftaran;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        $password = Hash::make('password');

        // ─── Admin Accounts ──────────────────────────────────────
        $superadmin = User::firstOrCreate(['email' => 'superadmin@ppdb.test'], [
            'name' => 'Super Admin',
            'password' => $password,
            'email_verified_at' => now(),
            'is_active' => true,
        ]);
        $superadmin->assignRole('Super Admin');

        $admin = User::firstOrCreate(['email' => 'admin@ppdb.test'], [
            'name' => 'Admin Utama',
            'password' => $password,
            'email_verified_at' => now(),
            'is_active' => true,
        ]);
        $admin->assignRole('Admin');

        $operator = User::firstOrCreate(['email' => 'operator@ppdb.test'], [
            'name' => 'Operator Sekolah',
            'password' => $password,
            'email_verified_at' => now(),
            'is_active' => true,
        ]);
        $operator->assignRole('Operator');

        $verifikator = User::firstOrCreate(['email' => 'verifikator@ppdb.test'], [
            'name' => 'Tim Verifikator',
            'password' => $password,
            'email_verified_at' => now(),
            'is_active' => true,
        ]);
        $verifikator->assignRole('Verifikator');

        // ─── Tahun Ajaran & Periode ──────────────────────────────
        $ta = TahunAjaran::updateOrCreate(['nama' => '2026/2027'], [
            'status_aktif' => true,
        ]);

        $periode = PeriodePpdb::updateOrCreate(
            ['tahun_ajaran_id' => $ta->id, 'nama' => 'Gelombang 1'],
            [
                'tanggal_mulai' => '2026-07-01',
                'tanggal_selesai' => '2026-08-31',
                'status_aktif' => true,
            ]
        );

        // ─── Jalur Pendaftaran ──────────────────────────────────
        $jalurZonasi = JalurPendaftaran::updateOrCreate(
            ['slug' => 'zonasi'],
            [
                'nama' => 'Zonasi',
                'kuota' => 50,
                'deskripsi' => 'Pendaftaran berdasarkan zonasi wilayah tempat tinggal',
                'status' => true,
            ]
        );

        $jalurPrestasi = JalurPendaftaran::updateOrCreate(
            ['slug' => 'prestasi'],
            [
                'nama' => 'Prestasi',
                'kuota' => 20,
                'deskripsi' => 'Pendaftaran berdasarkan prestasi akademik dan non-akademik',
                'status' => true,
            ]
        );

        // ─── Persyaratan Dokumen ────────────────────────────────
        $dokumenRequirements = [
            ['nama' => 'Pas Foto 3x4', 'slug' => 'zonasi-pas-foto', 'format' => 'jpg,jpeg,png', 'max_size' => 2048, 'is_wajib' => true, 'kategori' => 'Identitas', 'urutan' => 1],
            ['nama' => 'Kartu Keluarga', 'slug' => 'zonasi-kk', 'format' => 'pdf,jpg,jpeg,png', 'max_size' => 3072, 'is_wajib' => true, 'kategori' => 'Identitas', 'urutan' => 2],
            ['nama' => 'Akta Kelahiran', 'slug' => 'zonasi-akta', 'format' => 'pdf,jpg,jpeg,png', 'max_size' => 3072, 'is_wajib' => true, 'kategori' => 'Identitas', 'urutan' => 3],
            ['nama' => 'Ijazah / SKL', 'slug' => 'zonasi-ijazah', 'format' => 'pdf,jpg,jpeg,png', 'max_size' => 5120, 'is_wajib' => true, 'kategori' => 'Akademik', 'urutan' => 4],
            ['nama' => 'Rapor', 'slug' => 'zonasi-rapor', 'format' => 'pdf', 'max_size' => 5120, 'is_wajib' => false, 'kategori' => 'Akademik', 'urutan' => 5],
            ['nama' => 'Sertifikat Prestasi', 'slug' => 'zonasi-sertifikat', 'format' => 'pdf,jpg,jpeg,png', 'max_size' => 3072, 'is_wajib' => false, 'kategori' => 'Prestasi', 'urutan' => 6],
            ['nama' => 'Surat Keterangan Tidak Mampu', 'slug' => 'zonasi-sktm', 'format' => 'pdf,jpg,jpeg,png', 'max_size' => 3072, 'is_wajib' => false, 'kategori' => 'Lainnya', 'urutan' => 7],
        ];

        foreach ($dokumenRequirements as $doc) {
            PersyaratanDokumen::updateOrCreate(
                ['slug' => $doc['slug'], 'jalur_pendaftaran_id' => $jalurZonasi->id],
                array_merge($doc, ['jalur_pendaftaran_id' => $jalurZonasi->id, 'status' => true, 'keterangan' => "Dokumen wajib: {$doc['nama']}"])
            );
        }

        $dokumenPrestasi = [
            ['nama' => 'Pas Foto 3x4', 'slug' => 'prestasi-pas-foto', 'format' => 'jpg,jpeg,png', 'max_size' => 2048, 'is_wajib' => true, 'kategori' => 'Identitas', 'urutan' => 1],
            ['nama' => 'Kartu Keluarga', 'slug' => 'prestasi-kk', 'format' => 'pdf,jpg,jpeg,png', 'max_size' => 3072, 'is_wajib' => true, 'kategori' => 'Identitas', 'urutan' => 2],
            ['nama' => 'Akta Kelahiran', 'slug' => 'prestasi-akta', 'format' => 'pdf,jpg,jpeg,png', 'max_size' => 3072, 'is_wajib' => true, 'kategori' => 'Identitas', 'urutan' => 3],
            ['nama' => 'Ijazah / SKL', 'slug' => 'prestasi-ijazah', 'format' => 'pdf,jpg,jpeg,png', 'max_size' => 5120, 'is_wajib' => true, 'kategori' => 'Akademik', 'urutan' => 4],
            ['nama' => 'Sertifikat Prestasi', 'slug' => 'prestasi-sertifikat', 'format' => 'pdf,jpg,jpeg,png', 'max_size' => 3072, 'is_wajib' => true, 'kategori' => 'Prestasi', 'urutan' => 5],
        ];

        foreach ($dokumenPrestasi as $doc) {
            PersyaratanDokumen::updateOrCreate(
                ['slug' => $doc['slug'], 'jalur_pendaftaran_id' => $jalurPrestasi->id],
                array_merge($doc, ['jalur_pendaftaran_id' => $jalurPrestasi->id, 'status' => true, 'keterangan' => "Dokumen wajib: {$doc['nama']}"])
            );
        }

        // ─── 1 Peserta (Lengkap: User → Biodata → Orang Tua → Sekolah Asal → Pendaftaran → Selesai) ────────
        $pesertaUser = User::firstOrCreate(['email' => 'peserta@ppdb.test'], [
            'name' => 'Ahmad Rizky Pratama',
            'password' => $password,
            'email_verified_at' => now(),
            'is_active' => true,
        ]);
        $pesertaUser->assignRole('Peserta');

        $peserta = Peserta::updateOrCreate(['user_id' => $pesertaUser->id], [
            'nisn' => '0065432101',
            'nik' => '7371012345670001',
            'nama_lengkap' => 'Ahmad Rizky Pratama',
            'tempat_lahir' => 'Makassar',
            'tanggal_lahir' => '2014-05-15',
            'jenis_kelamin' => 'L',
            'agama' => 'Islam',
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Merdeka No. 10, Kel. Panakkukang',
            'provinsi' => 'Sulawesi Selatan',
            'kabupaten' => 'Makassar',
            'kecamatan' => 'Panakkukang',
            'kelurahan' => 'Panakkukang',
            'kode_pos' => '90231',
        ]);

        // Orang Tua
        $peserta->orangTua()->updateOrCreate(['peserta_id' => $peserta->id], [
            'nama_ayah' => 'Budi Pratama',
            'nik_ayah' => '7371012345670010',
            'pekerjaan_ayah' => 'PNS',
            'nama_ibu' => 'Siti Rahmawati',
            'nik_ibu' => '7371012345670011',
            'pekerjaan_ibu' => 'Guru',
            'penghasilan' => 8500000,
            'no_hp' => '081234567891',
        ]);

        // Sekolah Asal
        $peserta->sekolahAsal()->updateOrCreate(['peserta_id' => $peserta->id], [
            'nama_sekolah' => 'SDN 3 Panakkukang',
            'npsn' => '40305678',
            'alamat' => 'Jl. Perintis Kemerdekaan No. 5',
            'tahun_lulus' => 2026,
        ]);

        // Pendaftaran (status: diterima — full flow completed)
        $pendaftaran = Pendaftaran::updateOrCreate(
            ['user_id' => $pesertaUser->id, 'periode_ppdb_id' => $periode->id],
            [
                'peserta_id' => $peserta->id,
                'tahun_ajaran_id' => $ta->id,
                'jalur_pendaftaran_id' => $jalurZonasi->id,
                'nomor_pendaftaran' => 'PPDB-2026-000001',
                'status_pendaftaran' => 'diterima',
                'tanggal_submit' => now()->subDays(10),
            ]
        );

        // Dokumen yang di-upload (simulasi file path)
        $dokumenWajib = PersyaratanDokumen::where('jalur_pendaftaran_id', $jalurZonasi->id)->where('is_wajib', true)->get();
        foreach ($dokumenWajib as $i => $dok) {
            DokumenPendaftaran::updateOrCreate(
                ['pendaftaran_id' => $pendaftaran->id, 'persyaratan_dokumen_id' => $dok->id],
                [
                    'file' => "dummy/{$dok->slug}.pdf",
                    'status' => 'terverifikasi',
                    'verified_at' => now()->subDays(5),
                ]
            );
        }

        // Verifikasi
        VerifikasiPendaftaran::updateOrCreate(
            ['pendaftaran_id' => $pendaftaran->id],
            [
                'verifikator_id' => $verifikator->id,
                'status' => 'terverifikasi',
                'catatan' => 'Semua dokumen lengkap dan valid.',
                'tanggal_verifikasi' => now()->subDays(5),
            ]
        );

        // Hasil Seleksi
        HasilSeleksi::updateOrCreate(
            ['pendaftaran_id' => $pendaftaran->id],
            [
                'nilai' => 92.50,
                'peringkat' => 3,
                'status' => 'diterima',
                'keterangan' => 'Selamat! Anda diterima di SDN 1 Maju Makmur.',
            ]
        );

        // Daftar Ulang
        DaftarUlang::updateOrCreate(
            ['pendaftaran_id' => $pendaftaran->id],
            [
                'status' => 'sudah',
                'tanggal_daftar_ulang' => now()->subDays(2),
                'catatan' => 'Daftar ulang selesai, siswa sudah melengkapi berkas.',
            ]
        );

        // ─── CMS Content ────────────────────────────────────────

        // Hero Banners
        HeroBanner::updateOrCreate(['judul' => 'PPDB 2026/2027'], [
            'sub_judul' => 'Penerimaan Peserta Didik Baru Telah Dibuka',
            'deskripsi' => 'Daftar sekarang dan wujudkan masa depan gemilang bersama kami. Pendaftaran 100% online, mudah, dan transparan.',
            'gambar' => 'dummy/hero-1.jpg',
            'button_text' => 'Daftar Sekarang',
            'button_link' => '/register',
            'urutan' => 1,
            'status' => true,
        ]);

        HeroBanner::updateOrCreate(['judul' => 'Sekolah Unggulan Terakreditasi A'], [
            'sub_judul' => 'Pendidikan Berkualitas untuk Generasi Cemerlang',
            'deskripsi' => 'Tenaga pengajar profesional, fasilitas lengkap, dan kurikulum terdepan.',
            'gambar' => 'dummy/hero-2.jpg',
            'button_text' => 'Selengkapnya',
            'button_link' => '/berita',
            'urutan' => 2,
            'status' => true,
        ]);

        // Sambutan Kepala Sekolah
        SambutanKepalaSekolah::updateOrCreate(['jabatan' => 'Kepala Sekolah'], [
            'nama' => 'Drs. H. Muhammad Idrus, M.Pd.',
            'foto' => 'dummy/kepsek.jpg',
            'isi' => 'Assalamualaikum Warahmatullahi Wabarakatuh. Selamat datang di website resmi SDN 1 Maju Makmur. Kami berkomitmen untuk memberikan pendidikan terbaik bagi putra-putri tercinta. Melalui sistem PPDB online ini, kami berusaha memberikan kemudahan akses bagi seluruh calon peserta didik baru. Mari bersama-sama membangun generasi yang cerdas, berkarakter, dan berprestasi.',
        ]);

        // Statistik Sekolah
        $statistik = [
            ['judul' => 'Siswa Aktif', 'jumlah' => 1250, 'icon' => 'fas fa-user-graduate', 'urutan' => 1],
            ['judul' => 'Guru & Staff', 'jumlah' => 65, 'icon' => 'fas fa-chalkboard-teacher', 'urutan' => 2],
            ['judul' => 'Rombel', 'jumlah' => 36, 'icon' => 'fas fa-door-open', 'urutan' => 3],
            ['judul' => 'Prestasi', 'jumlah' => 128, 'icon' => 'fas fa-trophy', 'urutan' => 4],
        ];
        foreach ($statistik as $stat) {
            StatistikSekolah::updateOrCreate(['judul' => $stat['judul']], $stat);
        }

        // Keunggulan Sekolah
        $keunggulan = [
            ['judul' => 'Kurikulum Merdeka', 'deskripsi' => 'Penerapan kurikulum terbaru dengan pendekatan projek penguatan profil pelajar pancasila.', 'icon' => 'fas fa-book-open', 'urutan' => 1],
            ['judul' => 'Laboratorium Komputer', 'deskripsi' => 'Fasilitas lab komputer modern dengan akses internet unlimited untuk pembelajaran digital.', 'icon' => 'fas fa-laptop-code', 'urutan' => 2],
            ['judul' => 'Program Tahfidz', 'deskripsi' => 'Program menghafal Al-Qur\'an dengan metode yang menyenangkan dan bimbingan ustadz profesional.', 'icon' => 'fas fa-book', 'urutan' => 3],
            ['judul' => 'Ekstrakurikuler Lengkap', 'deskripsi' => 'Lebih dari 15 kegiatan ekstrakurikuler: pramuka, robotik, futsal, renang, dan lainnya.', 'icon' => 'fas fa-running', 'urutan' => 4],
        ];
        foreach ($keunggulan as $k) {
            KeunggulanSekolah::updateOrCreate(['judul' => $k['judul']], array_merge($k, ['gambar' => null]));
        }

        // Tahapan PPDB
        $tahapan = [
            ['judul' => 'Pendaftaran Online', 'deskripsi' => 'Calon peserta didik melakukan pendaftaran melalui website ini. Isi data diri, unggah dokumen, dan pilih jalur pendaftaran.', 'urutan' => 1],
            ['judul' => 'Verifikasi Berkas', 'deskripsi' => 'Tim verifikator akan mengecek kelengkapan dan keaslian dokumen yang diunggah oleh calon peserta didik.', 'urutan' => 2],
            ['judul' => 'Seleksi', 'deskripsi' => 'Proses seleksi berdasarkan kriteria jalur yang dipilih: zonasi, prestasi, atau jalur khusus lainnya.', 'urutan' => 3],
            ['judul' => 'Pengumuman', 'deskripsi' => 'Hasil seleksi diumumkan melalui website. Peserta dapat melihat status pendaftaran di dashboard.', 'urutan' => 4],
            ['judul' => 'Daftar Ulang', 'deskripsi' => 'Peserta yang diterima melakukan daftar ulang dengan melengkapi berkas dan membayar biaya pendaftaran.', 'urutan' => 5],
        ];
        foreach ($tahapan as $t) {
            TahapanPpdb::updateOrCreate(['judul' => $t['judul']], $t);
        }

        // Jadwal PPDB
        $jadwal = [
            ['kegiatan' => 'Pendaftaran Dibuka', 'tanggal_mulai' => '2026-07-01', 'tanggal_selesai' => '2026-07-15', 'deskripsi' => 'Masa pendaftaran online gelombang 1', 'urutan' => 1],
            ['kegiatan' => 'Verifikasi Berkas', 'tanggal_mulai' => '2026-07-16', 'tanggal_selesai' => '2026-07-25', 'deskripsi' => 'Proses verifikasi dokumen oleh tim', 'urutan' => 2],
            ['kegiatan' => 'Seleksi & Penilaian', 'tanggal_mulai' => '2026-07-26', 'tanggal_selesai' => '2026-08-01', 'deskripsi' => 'Proses seleksi dan penilaian', 'urutan' => 3],
            ['kegiatan' => 'Pengumuman Kelulusan', 'tanggal_mulai' => '2026-08-05', 'tanggal_selesai' => null, 'deskripsi' => 'Pengumuman hasil seleksi melalui website', 'urutan' => 4],
            ['kegiatan' => 'Daftar Ulang', 'tanggal_mulai' => '2026-08-06', 'tanggal_selesai' => '2026-08-20', 'deskripsi' => 'Daftar ulang bagi peserta yang diterima', 'urutan' => 5],
        ];
        foreach ($jadwal as $j) {
            JadwalPpdb::updateOrCreate(['kegiatan' => $j['kegiatan']], $j);
        }

        // FAQ
        $faqs = [
            ['pertanyaan' => 'Bagaimana cara mendaftar PPDB online?', 'jawaban' => 'Klik tombol "Daftar Sekarang" pada halaman utama, lalu ikuti langkah-langkah pendaftaran: isi biodata, data orang tua, sekolah asal, pilih jalur, unggah dokumen, dan submit pendaftaran.', 'urutan' => 1, 'status' => true],
            ['pertanyaan' => 'Dokumen apa saja yang harus diunggah?', 'jawaban' => 'Dokumen wajib meliputi: pas foto 3x4, Kartu Keluarga, Akta Kelahiran, dan Ijazah/SKL. Beberapa jalur mungkin mempersyaratkan dokumen tambahan seperti sertifikat prestasi atau SKTM.', 'urutan' => 2, 'status' => true],
            ['pertanyaan' => 'Bagaimana mengetahui hasil seleksi?', 'jawaban' => 'Hasil seleksi dapat dilihat melalui dashboard peserta setelah pengumuman. Anda juga akan mendapat notifikasi terkait perubahan status pendaftaran.', 'urutan' => 3, 'status' => true],
            ['pertanyaan' => 'Apakah bisa mendaftar di lebih dari satu jalur?', 'jawaban' => 'Tidak, setiap peserta hanya dapat mendaftar di satu jalur pendaftaran. Pastikan memilih jalur yang sesuai dengan kriteria Anda.', 'urutan' => 4, 'status' => true],
            ['pertanyaan' => 'Bagaimana jika dokumen saya ditolak?', 'jawaban' => 'Jika dokumen dinyatakan revisi, Anda akan mendapat notifikasi. Silakan perbaiki dan unggah ulang dokumen tersebut sebelum batas waktu yang ditentukan.', 'urutan' => 5, 'status' => true],
        ];
        foreach ($faqs as $f) {
            Faq::updateOrCreate(['pertanyaan' => $f['pertanyaan']], $f);
        }

        // Berita
        $beritas = [
            ['judul' => 'PPDB 2026/2027 Resmi Dibuka', 'slug' => 'ppdb-2026-2027-resmi-dibuka', 'konten' => '<p>Dengan bangga kami umumkan bahwa Penerimaan Peserta Didik Baru tahun ajaran 2026/2027 telah resmi dibuka. Pendaftaran dapat dilakukan secara online melalui website ini mulai tanggal 1 Juli 2026.</p><p>Segera daftarkan putra-putri Anda dan jadilah bagian dari keluarga besar SDN 1 Maju Makmur.</p>', 'status' => true, 'published_at' => now()->subDays(3)],
            ['judul' => 'Kurikulum Merdeka Diterapkan Mulai Tahun Ajaran Baru', 'slug' => 'kurikulum-merdeka-diterapkan', 'konten' => '<p>SDN 1 Maju Makmur siap menerapkan Kurikulum Merdeka secara penuh. Kurikulum ini memberikan fleksibilitas lebih bagi guru dan siswa dalam proses pembelajaran.</p>', 'status' => true, 'published_at' => now()->subDays(7)],
            ['judul' => 'Prestasi Siswa di Olimpiade Sains Tingkat Provinsi', 'slug' => 'prestasi-siswa-olimpiade-sains', 'konten' => '<p>Selamat kepada 5 siswa kami yang telah meraih medali emas dan perak dalam Olimpiade Sains tingkat Provinsi Sulawesi Selatan. Prestasi ini membuktikan komitmen sekolah dalam mengembangkan potensi siswa.</p>', 'status' => true, 'published_at' => now()->subDays(14)],
        ];
        foreach ($beritas as $b) {
            Berita::updateOrCreate(['slug' => $b['slug']], $b);
        }

        // Pengumuman
        $pengumumans = [
            ['judul' => 'Jadwal Pelaksanaan PPDB 2026/2027', 'slug' => 'jadwal-ppdb-2026-2027', 'isi' => 'Pendaftaran PPDB 2026/2027 dibuka mulai 1 Juli hingga 31 Agustus 2026. Pengumuman kelulusan pada 5 Agustus 2026. Daftar ulang 6-20 Agustus 2026.', 'status' => true],
            ['judul' => 'Panduan Lengkap PPDB Online', 'slug' => 'panduan-lengkap-ppdb-online', 'isi' => 'Unduh panduan lengkap pendaftaran PPDB online di halaman ini. Panduan berisi langkah demi langkah proses pendaftaran hingga daftar ulang.', 'status' => true],
        ];
        foreach ($pengumumans as $p) {
            Pengumuman::updateOrCreate(['slug' => $p['slug']], $p);
        }

        // Galeri
        $galeris = [
            ['judul' => 'Upacara Bendera Senin Pagi', 'gambar' => 'dummy/galeri-1.jpg', 'kategori' => 'Kegiatan'],
            ['judul' => 'Perayaan Hari Pendidikan Nasional', 'gambar' => 'dummy/galeri-2.jpg', 'kategori' => 'Event'],
            ['judul' => 'Kegiatan Pramuka', 'gambar' => 'dummy/galeri-3.jpg', 'kategori' => 'Ekstrakurikuler'],
            ['judul' => 'Laboratorium Sains', 'gambar' => 'dummy/galeri-4.jpg', 'kategori' => 'Fasilitas'],
            ['judul' => 'Perpustakaan Sekolah', 'gambar' => 'dummy/galeri-5.jpg', 'kategori' => 'Fasilitas'],
            ['judul' => 'Lomba Kreativitas Siswa', 'gambar' => 'dummy/galeri-6.jpg', 'kategori' => 'Event'],
        ];
        foreach ($galeris as $g) {
            Galeri::updateOrCreate(['judul' => $g['judul']], $g);
        }

        // Testimoni
        $testimonis = [
            ['nama' => 'Ibu Sarah Wijaya', 'isi' => 'Alhamdulillah, anak saya sangat senang belajar di sini. Guru-gurunya ramah dan peduli. Fasilitas sekolah juga sangat memadai.', 'angkatan' => '2024', 'status' => true],
            ['nama' => 'Bapak Andi Kurniawan', 'isi' => 'Sekolah ini memberikan pendidikan yang holistik. Tidak hanya akademik, tapi juga karakter dan keterampilan hidup. Sangat direkomendasikan.', 'angkatan' => '2023', 'status' => true],
            ['nama' => 'Ibu Rina Susanti', 'isi' => 'Program tahfidz-nya luar biasa. Anak saya sekarang sudah hafal 5 juz. Terima kasih SDN 1 Maju Makmur!', 'angkatan' => '2025', 'status' => true],
        ];
        foreach ($testimonis as $t) {
            Testimoni::updateOrCreate(['nama' => $t['nama']], $t);
        }

        // Kontak
        Kontak::updateOrCreate(['id' => 1], [
            'alamat' => 'Jl. Pendidikan No. 123, Kel. Mekar, Kec. Tamalate, Kota Makassar, Sulawesi Selatan 90231',
            'email' => 'info@sdn1majumakmur.sch.id',
            'telepon' => '(0411) 123456',
            'whatsapp' => '6281234567890',
            'google_maps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.123456789!2d119.4!3d-5.14!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNcKwMDgnMjQuMCJTIDExOcKwMjQnMDAuMCJF!5e0!3m2!1sid!2sid!4v1234567890',
        ]);

        // Footer
        \App\Models\Footer::updateOrCreate(['id' => 1], [
            'copyright' => date('Y') . ' SDN 1 Maju Makmur. All rights reserved.',
            'deskripsi' => 'Mewujudkan peserta didik yang beriman, cerdas, kreatif, dan berkarakter mulia.',
            'alamat' => 'Jl. Pendidikan No. 123, Makassar',
            'email' => 'info@sdn1majumakmur.sch.id',
            'telepon' => '(0411) 123456',
        ]);

        // SEO
        Seo::updateOrCreate(['id' => 1], [
            'meta_title' => 'PPDB Online - SDN 1 Maju Makmur',
            'meta_description' => 'Penerimaan Peserta Didik Baru SDN 1 Maju Makmur Tahun Ajaran 2026/2027. Daftar online, mudah, dan transparan.',
            'meta_keywords' => 'PPDB, Penerimaan Siswa Baru, SDN 1 Maju Makmur, Sekolah Dasar, Makassar',
        ]);

        // ─── Notifications (sample for admin) ───────────────────
        \App\Models\Notification::createNotif(
            'Pendaftaran baru dari Ahmad Rizky Pratama',
            '/admin/verifikasi',
            'plus-circle',
            $superadmin
        );

        \App\Models\Notification::createNotif(
            'Pengumuman PPDB 2026/2027 telah dipublikasikan',
            '/admin/pengumuman',
            'megaphone',
            $superadmin
        );
    }
}
