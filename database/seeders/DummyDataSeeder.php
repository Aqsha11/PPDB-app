<?php

namespace Database\Seeders;

use App\Models\{
    TahunAjaran,
    PeriodePpdb,
    JalurPendaftaran,
    PersyaratanDokumen,
    Siswa,
    OrangTua,
    SekolahAsal,
    Pendaftaran,
    DokumenPendaftaran,
    VerifikasiPendaftaran,
    HasilSeleksi,
    DaftarUlang,
    User,
    ProfilSekolah,
    SambutanKepalaSekolah,
    StatistikSekolah,
    KeunggulanSekolah,
    TahapanPpdb,
    JadwalPpdb,
    Faq,
    Berita,
    Pengumuman,
    HeroBanner,
    Galeri,
    Video,
    Testimoni,
    Partner,
    MediaSosial,
    Kontak,
    Footer,
    Seo,
};
use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Seeding master data...');
        $this->seedMasterData();

        $this->command->info('Seeding CMS content...');
        $this->seedCmsContent();

        $this->command->info('Seeding student registrations...');
        $this->seedPendaftaran();

        $this->command->info('All dummy data created successfully!');
    }

    protected function seedMasterData(): void
    {
        $ta2025 = TahunAjaran::create(['nama' => '2025/2026', 'status_aktif' => true]);
        $ta2024 = TahunAjaran::create(['nama' => '2024/2025', 'status_aktif' => false]);

        PeriodePpdb::create([
            'tahun_ajaran_id' => $ta2025->id,
            'nama' => 'Gelombang 1',
            'tanggal_mulai' => '2025-01-01',
            'tanggal_selesai' => '2025-03-31',
            'status_aktif' => true,
        ]);
        PeriodePpdb::create([
            'tahun_ajaran_id' => $ta2025->id,
            'nama' => 'Gelombang 2',
            'tanggal_mulai' => '2025-04-01',
            'tanggal_selesai' => '2025-06-30',
            'status_aktif' => false,
        ]);
        PeriodePpdb::create([
            'tahun_ajaran_id' => $ta2024->id,
            'nama' => 'Gelombang 1',
            'tanggal_mulai' => '2024-01-01',
            'tanggal_selesai' => '2024-06-30',
            'status_aktif' => false,
        ]);

        $zonasi = JalurPendaftaran::create([
            'nama' => 'Zonasi',
            'slug' => 'zonasi',
            'kuota' => 60,
            'deskripsi' => 'Jalur pendaftaran berdasarkan jarak tempat tinggal dengan sekolah.',
            'status' => true,
        ]);
        $prestasi = JalurPendaftaran::create([
            'nama' => 'Prestasi',
            'slug' => 'prestasi',
            'kuota' => 25,
            'deskripsi' => 'Jalur pendaftaran bagi siswa dengan prestasi akademik dan non-akademik.',
            'status' => true,
        ]);
        $afirmasi = JalurPendaftaran::create([
            'nama' => 'Afirmasi',
            'slug' => 'afirmasi',
            'kuota' => 10,
            'deskripsi' => 'Jalur pendaftaran bagi siswa dari keluarga kurang mampu.',
            'status' => true,
        ]);
        $mutasi = JalurPendaftaran::create([
            'nama' => 'Perpindahan Tugas Orang Tua',
            'slug' => 'perpindahan-tugas-orang-tua',
            'kuota' => 5,
            'deskripsi' => 'Jalur pendaftaran bagi siswa yang orang tuanya pindah tugas.',
            'status' => true,
        ]);

        $commonDocs = [
            ['nama' => 'Kartu Keluarga', 'format' => 'pdf,jpg,png', 'max_size' => 2048, 'is_wajib' => true],
            ['nama' => 'Akta Kelahiran', 'format' => 'pdf,jpg,png', 'max_size' => 2048, 'is_wajib' => true],
            ['nama' => 'Pas Foto', 'format' => 'jpg,png', 'max_size' => 1024, 'is_wajib' => true],
        ];
        $prestasiDocs = [
            ['nama' => 'Sertifikat Prestasi', 'format' => 'pdf,jpg,png', 'max_size' => 2048, 'is_wajib' => true],
        ];
        $afirmasiDocs = [
            ['nama' => 'Surat Keterangan Tidak Mampu', 'format' => 'pdf', 'max_size' => 2048, 'is_wajib' => true],
        ];
        $mutasiDocs = [
            ['nama' => 'Surat Penugasan Orang Tua', 'format' => 'pdf', 'max_size' => 2048, 'is_wajib' => true],
        ];

        foreach ($commonDocs as $doc) {
            foreach ([$zonasi->id, $prestasi->id, $afirmasi->id, $mutasi->id] as $jpId) {
                PersyaratanDokumen::create(array_merge($doc, [
                    'jalur_pendaftaran_id' => $jpId,
                    'slug' => str($doc['nama'])->slug()->append('-' . $jpId),
                    'status' => true,
                ]));
            }
        }
        foreach ($prestasiDocs as $doc) {
            PersyaratanDokumen::create(array_merge($doc, [
                'jalur_pendaftaran_id' => $prestasi->id,
                'slug' => str($doc['nama'])->slug(),
                'status' => true,
            ]));
        }
        foreach ($afirmasiDocs as $doc) {
            PersyaratanDokumen::create(array_merge($doc, [
                'jalur_pendaftaran_id' => $afirmasi->id,
                'slug' => str($doc['nama'])->slug(),
                'status' => true,
            ]));
        }
        foreach ($mutasiDocs as $doc) {
            PersyaratanDokumen::create(array_merge($doc, [
                'jalur_pendaftaran_id' => $mutasi->id,
                'slug' => str($doc['nama'])->slug(),
                'status' => true,
            ]));
        }
    }

    protected function seedCmsContent(): void
    {
        ProfilSekolah::create([
            'nama_sekolah' => 'SD Negeri Harapan Bangsa',
            'logo' => null,
            'visi' => 'Terwujudnya generasi beriman, berilmu, berkarakter, dan berbudaya lingkungan.',
            'misi' => "1. Menanamkan nilai-nilai keimanan dan ketakwaan\n2. Mengembangkan potensi akademik dan non-akademik\n3. Membentuk karakter disiplin, jujur, dan bertanggung jawab\n4. Menciptakan lingkungan sekolah yang bersih, hijau, dan sehat",
            'sejarah' => 'SD Negeri Harapan Bangsa berdiri sejak tahun 1985 dan telah melahirkan ribuan lulusan yang berprestasi di berbagai bidang.',
        ]);

        SambutanKepalaSekolah::create([
            'nama' => 'Drs. Ahmad Supriyatna, M.Pd.',
            'jabatan' => 'Kepala Sekolah',
            'foto' => null,
            'isi' => 'Assalamualaikum warahmatullahi wabarakatuh. Selamat datang di website SD Negeri Harapan Bangsa. Kami berkomitmen untuk memberikan pendidikan terbaik bagi putra-putri Anda. Melalui PPDB online ini, kami berharap proses pendaftaran menjadi lebih mudah, transparan, dan akuntabel. Mari bergabung bersama kami untuk mewujudkan generasi emas Indonesia.',
        ]);

        $stats = [
            ['judul' => 'Guru & Tenaga Pendidik', 'jumlah' => 42, 'icon' => 'fas fa-chalkboard-teacher'],
            ['judul' => 'Siswa Aktif', 'jumlah' => 560, 'icon' => 'fas fa-user-graduate'],
            ['judul' => 'Rombongan Belajar', 'jumlah' => 18, 'icon' => 'fas fa-school'],
            ['judul' => 'Ekstrakurikuler', 'jumlah' => 12, 'icon' => 'fas fa-futbol'],
            ['judul' => 'Prestasi Nasional', 'jumlah' => 25, 'icon' => 'fas fa-trophy'],
        ];
        foreach ($stats as $i => $s) {
            StatistikSekolah::create(array_merge($s, ['urutan' => $i + 1]));
        }

        $unggulan = [
            ['judul' => 'Kurikulum Terpadu', 'deskripsi' => 'Mengintegrasikan kurikulum nasional dengan nilai-nilai karakter dan keagamaan.', 'icon' => 'fas fa-book-open', 'urutan' => 1],
            ['judul' => 'Guru Profesional', 'deskripsi' => 'Tenaga pendidik bersertifikasi dan berpengalaman di bidangnya masing-masing.', 'icon' => 'fas fa-user-tie', 'urutan' => 2],
            ['judul' => 'Fasilitas Lengkap', 'deskripsi' => 'Lab komputer, perpustakaan digital, lapangan olahraga, dan ruang multimedia.', 'icon' => 'fas fa-building', 'urutan' => 3],
            ['judul' => 'Pembiasaan Karakter', 'deskripsi' => 'Program pembiasaan sholat dhuha, literasi pagi, dan jumat bersih.', 'icon' => 'fas fa-heart', 'urutan' => 4],
        ];
        foreach ($unggulan as $u) {
            KeunggulanSekolah::create($u);
        }

        $tahapan = [
            ['judul' => 'Pendaftaran Online', 'deskripsi' => 'Calon siswa mengisi formulir pendaftaran melalui website resmi sekolah.', 'urutan' => 1],
            ['judul' => 'Verifikasi Dokumen', 'deskripsi' => 'Petugas memverifikasi kelengkapan dan keabsahan dokumen pendaftaran.', 'urutan' => 2],
            ['judul' => 'Seleksi', 'deskripsi' => 'Proses seleksi berdasarkan jalur pendaftaran yang dipilih.', 'urutan' => 3],
            ['judul' => 'Pengumuman', 'deskripsi' => 'Hasil seleksi diumumkan melalui website dan papan pengumuman sekolah.', 'urutan' => 4],
            ['judul' => 'Daftar Ulang', 'deskripsi' => 'Calon siswa yang diterima melakukan daftar ulang untuk konfirmasi.', 'urutan' => 5],
        ];
        foreach ($tahapan as $t) {
            TahapanPpdb::create($t);
        }

        $jadwal = [
            ['kegiatan' => 'Pendaftaran Gelombang 1', 'tanggal_mulai' => '2025-01-01', 'tanggal_selesai' => '2025-03-31', 'urutan' => 1],
            ['kegiatan' => 'Verifikasi Berkas', 'tanggal_mulai' => '2025-04-01', 'tanggal_selesai' => '2025-04-15', 'urutan' => 2],
            ['kegiatan' => 'Pengumuman Gelombang 1', 'tanggal_mulai' => '2025-04-20', 'tanggal_selesai' => null, 'urutan' => 3],
            ['kegiatan' => 'Pendaftaran Gelombang 2', 'tanggal_mulai' => '2025-05-01', 'tanggal_selesai' => '2025-06-30', 'urutan' => 4],
            ['kegiatan' => 'Masa Pengenalan Lingkungan Sekolah', 'tanggal_mulai' => '2025-07-14', 'tanggal_selesai' => '2025-07-16', 'urutan' => 5],
        ];
        foreach ($jadwal as $j) {
            JadwalPpdb::create($j);
        }

        $faqs = [
            ['pertanyaan' => 'Apa saja syarat pendaftaran PPDB?', 'jawaban' => 'Syarat utama meliputi: Kartu Keluarga, Akta Kelahiran, Pas Foto terbaru, dan dokumen tambahan sesuai jalur pendaftaran yang dipilih.', 'urutan' => 1, 'status' => true],
            ['pertanyaan' => 'Berapa biaya pendaftaran?', 'jawaban' => 'Pendaftaran PPDB di SD Negeri Harapan Bangsa TIDAK DIPUNGUT BIAYA alias gratis.', 'urutan' => 2, 'status' => true],
            ['pertanyaan' => 'Bagaimana cara memilih jalur pendaftaran?', 'jawaban' => 'Anda dapat memilih jalur yang sesuai dengan kriteria: Zonasi (berdasarkan jarak), Prestasi (akademik/non-akademik), Afirmasi (keluarga kurang mampu), atau Perpindahan Tugas Orang Tua.', 'urutan' => 3, 'status' => true],
            ['pertanyaan' => 'Kapan pengumuman hasil seleksi?', 'jawaban' => 'Pengumuman hasil seleksi akan diinformasikan melalui website sekolah dan papan pengumuman sesuai jadwal yang telah ditentukan.', 'urutan' => 4, 'status' => true],
            ['pertanyaan' => 'Apakah bisa mengubah data setelah disubmit?', 'jawaban' => 'Setelah data disubmit, Anda tidak dapat mengubahnya. Pastikan data yang diisi sudah benar dan lengkap sebelum menekan tombol submit.', 'urutan' => 5, 'status' => true],
        ];
        foreach ($faqs as $f) {
            Faq::create($f);
        }

        Berita::create([
            'judul' => 'Siswa SD Harapan Bangsa Raih Juara Olimpiade Sains Nasional',
            'slug' => 'siswa-raih-juara-osn',
            'thumbnail' => null,
            'konten' => "Kabar membanggakan datang dari siswa SD Negeri Harapan Bangsa. Tim olimpiade sains berhasil meraih medali emas dalam ajang Olimpiade Sains Nasional tingkat Kabupaten. Prestasi ini membuktikan kualitas pendidikan sains di sekolah kami.\n\nSelamat kepada para pemenang dan pembimbing yang telah berdedikasi tinggi.",
            'status' => true,
            'published_at' => '2025-02-15 08:00:00',
        ]);
        Berita::create([
            'judul' => 'Kegiatan Class Meeting Semester Ganjil 2025',
            'slug' => 'kegiatan-class-meeting-2025',
            'thumbnail' => null,
            'konten' => "Setelah menyelesaikan ujian akhir semester, SD Negeri Harapan Bangsa mengadakan kegiatan Class Meeting yang diikuti oleh seluruh siswa. Berbagai perlombaan digelar mulai dari futsal, cerdas cermat, hingga lomba kebersihan kelas. Kegiatan ini bertujuan untuk mempererat tali persaudaraan antar siswa.",
            'status' => true,
            'published_at' => '2025-01-20 10:00:00',
        ]);
        Berita::create([
            'judul' => 'Pendaftaran PPDB Tahun Ajaran 2025/2026 Dibuka',
            'slug' => 'pendaftaran-ppdb-2025-2026-dibuka',
            'thumbnail' => null,
            'konten' => "SD Negeri Harapan Bangsa membuka pendaftaran Penerimaan Peserta Didik Baru (PPDB) untuk tahun ajaran 2025/2026. Pendaftaran dilaksanakan secara online melalui website resmi sekolah. Tersedia 4 jalur pendaftaran: Zonasi, Prestasi, Afirmasi, dan Perpindahan Tugas Orang Tua.\n\nYuk daftarkan putra-putri Anda segera!",
            'status' => true,
            'published_at' => '2025-01-01 00:00:00',
        ]);

        $pengumuman = [
            ['judul' => 'Hasil Seleksi PPDB Gelombang 1', 'slug' => 'hasil-seleksi-gelombang-1', 'isi' => 'Hasil seleksi PPDB Gelombang 1 tahun ajaran 2025/2026 telah diumumkan. Silakan cek status pendaftaran melalui dashboard masing-masing.', 'status' => true],
            ['judul' => 'Jadwal MPLS Tahun Ajaran 2025/2026', 'slug' => 'jadwal-mpls-2025-2026', 'isi' => 'Masa Pengenalan Lingkungan Sekolah (MPLS) akan dilaksanakan pada tanggal 14-16 Juli 2025. Siswa baru diwajibkan mengikuti seluruh rangkaian kegiatan.', 'status' => true],
            ['judul' => 'Pengambilan Seragam dan Perlengkapan Sekolah', 'slug' => 'pengambilan-seragam-sekolah', 'isi' => 'Pengambilan seragam dan perlengkapan sekolah dapat dilakukan di koperasi sekolah mulai tanggal 1 Juli 2025 dengan membawa bukti daftar ulang.', 'status' => true],
        ];
        foreach ($pengumuman as $p) {
            Pengumuman::create($p);
        }

        $heroes = [
            ['judul' => 'Selamat Datang di PPDB Online', 'sub_judul' => 'SD Negeri Harapan Bangsa', 'deskripsi' => 'Proses pendaftaran mudah, transparan, dan akuntabel', 'gambar' => 'placeholder/hero-banner.jpg', 'button_text' => 'Daftar Sekarang', 'button_link' => '/register', 'urutan' => 1, 'status' => true],
            ['judul' => 'Wujudkan Generasi Berprestasi', 'sub_judul' => 'Bersama Kami', 'deskripsi' => 'Pendidikan berkualitas dengan kurikulum terpadu dan tenaga pendidik profesional', 'gambar' => 'placeholder/hero-banner.jpg', 'button_text' => 'Informasi Pendaftaran', 'button_link' => '/informasi', 'urutan' => 2, 'status' => true],
        ];
        foreach ($heroes as $h) {
            HeroBanner::create($h);
        }

        $galeri = [
            ['judul' => 'Kegiatan Belajar Mengajar', 'kategori' => 'Kegiatan'],
            ['judul' => 'Lomba 17 Agustus', 'kategori' => 'Kegiatan'],
            ['judul' => 'Perpustakaan Digital', 'kategori' => 'Fasilitas'],
            ['judul' => 'Lab Komputer', 'kategori' => 'Fasilitas'],
        ];
        foreach ($galeri as $g) {
            Galeri::create(array_merge($g, ['gambar' => 'placeholder/galeri.jpg']));
        }

        $videos = [
            ['judul' => 'Profil SD Negeri Harapan Bangsa', 'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'],
            ['judul' => 'Kegiatan Ekstrakurikuler', 'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'],
        ];
        foreach ($videos as $v) {
            Video::create($v);
        }

        $testimonis = [
            ['nama' => 'Budi Santoso', 'isi' => 'Saya sangat puas dengan kualitas pendidikan di SD Harapan Bangsa. Anak saya berkembang pesat baik akademik maupun karakternya.', 'angkatan' => '2020', 'status' => true],
            ['nama' => 'Siti Nurhaliza', 'isi' => 'Proses pendaftaran online sangat mudah dan transparan. Terima kasih SD Harapan Bangsa!', 'angkatan' => '2024', 'status' => true],
            ['nama' => 'Ahmad Rizki', 'isi' => 'Guru-guru sangat profesional dan peduli dengan perkembangan siswa. Sekolah yang recommended!', 'angkatan' => '2021', 'status' => true],
        ];
        foreach ($testimonis as $t) {
            Testimoni::create($t);
        }

        $partners = [
            ['nama' => 'Kemendikbud', 'website' => 'https://kemendikbud.go.id', 'urutan' => 1, 'status' => true],
            ['nama' => 'Dinas Pendidikan Jawa Barat', 'website' => 'https://disdik.jabarprov.go.id', 'urutan' => 2, 'status' => true],
            ['nama' => 'Kecamatan Citarum', 'website' => null, 'urutan' => 3, 'status' => true],
            ['nama' => 'Puskesmas Citarum', 'website' => null, 'urutan' => 4, 'status' => true],
        ];
        foreach ($partners as $p) {
            Partner::create(array_merge($p, ['logo' => 'placeholder/partner.png']));
        }

        $sosmeds = [
            ['platform' => 'Facebook', 'icon' => 'fab fa-facebook', 'url' => 'https://facebook.com/sdharapanbangsa', 'urutan' => 1, 'status' => true],
            ['platform' => 'Instagram', 'icon' => 'fab fa-instagram', 'url' => 'https://instagram.com/sdharapanbangsa', 'urutan' => 2, 'status' => true],
            ['platform' => 'YouTube', 'icon' => 'fab fa-youtube', 'url' => 'https://youtube.com/@sdharapanbangsa', 'urutan' => 3, 'status' => true],
            ['platform' => 'TikTok', 'icon' => 'fab fa-tiktok', 'url' => 'https://tiktok.com/@sdharapanbangsa', 'urutan' => 4, 'status' => true],
        ];
        foreach ($sosmeds as $s) {
            MediaSosial::create($s);
        }

        Kontak::create([
            'alamat' => 'Jl. Merdeka No. 123, Kel. Citarum, Kec. Bandung Wetan, Kota Bandung 40115',
            'email' => 'info@sdharapanbangsa.sch.id',
            'telepon' => '(022) 1234567',
            'whatsapp' => '08123456789',
            'google_maps' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.1!2d107.6!3d-6.9!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwNTQnMDAuMCJTIDEwN8KwMzYnMDAuMCJF!5e0!3m2!1sid!2sid!4v1" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
        ]);

        Footer::create([
            'copyright' => '2025 SD Negeri Harapan Bangsa. All rights reserved.',
            'deskripsi' => 'SD Negeri Harapan Bangsa berkomitmen memberikan pendidikan terbaik untuk generasi penerus bangsa.',
        ]);

        Seo::create([
            'meta_title' => 'PPDB SD Negeri Harapan Bangsa - Penerimaan Peserta Didik Baru',
            'meta_description' => 'PPDB Online SD Negeri Harapan Bangsa. Pendaftaran mudah, transparan, dan akuntabel. Tersedia jalur Zonasi, Prestasi, Afirmasi, dan Perpindahan Tugas Orang Tua.',
            'meta_keywords' => 'PPDB, pendaftaran sekolah, SD, penerimaan siswa baru, pendidikan',
            'og_image' => null,
            'favicon' => null,
        ]);
    }

    protected function seedPendaftaran(): void
    {
        $jalurs = JalurPendaftaran::pluck('id', 'slug');
        $periode = PeriodePpdb::where('status_aktif', true)->first();
        $tahunAjaran = TahunAjaran::where('status_aktif', true)->first();

        $siswaData = [
            ['name' => 'Ahmad Fauzi', 'nisn' => '1234567890', 'jenis_kelamin' => 'L', 'jalur' => 'zonasi', 'status' => 'diterima'],
            ['name' => 'Siti Rahmawati', 'nisn' => '1234567891', 'jenis_kelamin' => 'P', 'jalur' => 'prestasi', 'status' => 'diterima'],
            ['name' => 'Doni Prasetyo', 'nisn' => '1234567892', 'jenis_kelamin' => 'L', 'jalur' => 'zonasi', 'status' => 'diterima'],
            ['name' => 'Rina Marlina', 'nisn' => '1234567893', 'jenis_kelamin' => 'P', 'jalur' => 'afirmasi', 'status' => 'diterima'],
            ['name' => 'Rudi Hermawan', 'nisn' => '1234567894', 'jenis_kelamin' => 'L', 'jalur' => 'zonasi', 'status' => 'verifikasi'],
            ['name' => 'Dewi Sartika', 'nisn' => '1234567895', 'jenis_kelamin' => 'P', 'jalur' => 'prestasi', 'status' => 'verifikasi'],
            ['name' => 'Agus Wijaya', 'nisn' => '1234567896', 'jenis_kelamin' => 'L', 'jalur' => 'zonasi', 'status' => 'verifikasi'],
            ['name' => 'Fitri Handayani', 'nisn' => '1234567897', 'jenis_kelamin' => 'P', 'jalur' => 'perpindahan-tugas-orang-tua', 'status' => 'submitted'],
            ['name' => 'Bayu Saputra', 'nisn' => '1234567898', 'jenis_kelamin' => 'L', 'jalur' => 'zonasi', 'status' => 'submitted'],
            ['name' => 'Ani Nurjanah', 'nisn' => '1234567899', 'jenis_kelamin' => 'P', 'jalur' => 'afirmasi', 'status' => 'submitted'],
            ['name' => 'Cahyo Nugroho', 'nisn' => '1234567800', 'jenis_kelamin' => 'L', 'jalur' => 'zonasi', 'status' => 'cadangan'],
            ['name' => 'Indah Permatasari', 'nisn' => '1234567801', 'jenis_kelamin' => 'P', 'jalur' => 'prestasi', 'status' => 'cadangan'],
            ['name' => 'Eko Prasetyo', 'nisn' => '1234567802', 'jenis_kelamin' => 'L', 'jalur' => 'zonasi', 'status' => 'ditolak'],
            ['name' => 'Tari Susanti', 'nisn' => '1234567803', 'jenis_kelamin' => 'P', 'jalur' => 'zonasi', 'status' => 'draft'],
            ['name' => 'Gilang Ramadan', 'nisn' => '1234567804', 'jenis_kelamin' => 'L', 'jalur' => 'prestasi', 'status' => 'draft'],
        ];

        foreach ($siswaData as $i => $data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => str($data['name'])->lower()->replace(' ', '.')->append('@mail.test')->value(),
                'password' => bcrypt('password'),
                'is_active' => true,
                'email_verified_at' => now(),
            ]);
            $user->assignRole('Siswa');

            $siswa = Siswa::create([
                'user_id' => $user->id,
                'nisn' => $data['nisn'],
                'nik' => '320' . str_pad((string) $i, 12, '0', STR_PAD_LEFT),
                'nama_lengkap' => $data['name'],
                'tempat_lahir' => fake()->randomElement(['Bandung', 'Jakarta', 'Cimahi', 'Sumedang']),
                'tanggal_lahir' => fake()->dateTimeBetween('-15 years', '-11 years')->format('Y-m-d'),
                'jenis_kelamin' => $data['jenis_kelamin'],
                'agama' => fake()->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha']),
                'alamat' => fake()->streetAddress(),
                'provinsi' => 'Jawa Barat',
                'kabupaten' => fake()->randomElement(['Bandung', 'Bandung Barat', 'Cimahi']),
                'kecamatan' => fake()->streetName(),
                'kelurahan' => fake()->streetSuffix(),
                'kode_pos' => fake()->postcode(),
            ]);

            OrangTua::factory()->create(['siswa_id' => $siswa->id]);
            SekolahAsal::factory()->create(['siswa_id' => $siswa->id]);

            $isSubmitted = !in_array($data['status'], ['draft']);
            $pendaftaran = Pendaftaran::create([
                'user_id' => $user->id,
                'siswa_id' => $siswa->id,
                'tahun_ajaran_id' => $tahunAjaran->id,
                'periode_ppdb_id' => $periode->id,
                'jalur_pendaftaran_id' => $jalurs[$data['jalur']],
                'nomor_pendaftaran' => 'PPDB-2025-' . str_pad((string) ($i + 1), 3, '0', STR_PAD_LEFT),
                'status_pendaftaran' => $data['status'],
                'tanggal_submit' => $isSubmitted ? now()->subDays(rand(5, 60)) : null,
            ]);

            if ($isSubmitted) {
                $persyaratans = PersyaratanDokumen::where('jalur_pendaftaran_id', $jalurs[$data['jalur']])->get();
                foreach ($persyaratans as $pers) {
                    DokumenPendaftaran::factory()->create([
                        'pendaftaran_id' => $pendaftaran->id,
                        'persyaratan_dokumen_id' => $pers->id,
                    ]);
                }
            }

            if ($data['status'] === 'verifikasi') {
                $verifikator = User::role('Verifikator')->first() ?? User::role('Admin')->first();
                VerifikasiPendaftaran::create([
                    'pendaftaran_id' => $pendaftaran->id,
                    'verifikator_id' => $verifikator->id,
                    'status' => 'terverifikasi',
                    'catatan' => 'Dokumen lengkap dan valid.',
                    'tanggal_verifikasi' => now()->subDays(rand(1, 10)),
                ]);
            }

            if (in_array($data['status'], ['diterima', 'cadangan'])) {
                HasilSeleksi::create([
                    'pendaftaran_id' => $pendaftaran->id,
                    'nilai' => fake()->randomFloat(2, 60, 100),
                    'peringkat' => null,
                    'status' => $data['status'] === 'diterima' ? 'diterima' : 'cadangan',
                    'keterangan' => $data['status'] === 'diterima' ? 'Selamat! Anda dinyatakan lolos seleksi.' : 'Anda masuk dalam daftar cadangan.',
                ]);
            }

            if ($data['status'] === 'ditolak') {
                HasilSeleksi::create([
                    'pendaftaran_id' => $pendaftaran->id,
                    'nilai' => fake()->randomFloat(2, 30, 59),
                    'peringkat' => null,
                    'status' => 'tidak_diterima',
                    'keterangan' => 'Mohon maaf, Anda belum lolos seleksi untuk tahun ajaran ini.',
                ]);
            }

            if ($data['status'] === 'diterima' && $i < 2) {
                DaftarUlang::create([
                    'pendaftaran_id' => $pendaftaran->id,
                    'status' => 'sudah',
                    'tanggal_daftar_ulang' => now()->subDays(rand(1, 5)),
                ]);
            }
        }
    }
}
