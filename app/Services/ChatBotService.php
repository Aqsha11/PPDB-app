<?php

namespace App\Services;

use App\Models\Faq;
use App\Models\JalurPendaftaran;
use App\Models\Pengumuman;
use App\Models\PeriodePpdb;
use App\Models\PersyaratanDokumen;
use App\Models\ProfilSekolah;
use App\Models\JadwalPpdb;
use App\Models\TahapanPpdb;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatBotService
{
    protected string $apiKey;
    protected string $model;
    protected string $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key', '');
        $this->model = config('services.gemini.model', 'gemini-2.0-flash');
        $this->baseUrl = 'https://generativelanguage.googleapis.com/v1beta';
    }

    public function isEnabled(): bool
    {
        return !empty($this->apiKey);
    }

    public function getReply(string $userMessage, array $chatHistory = []): ?string
    {
        if (!$this->isEnabled()) {
            return $this->getFallbackReply($userMessage);
        }

        $systemPrompt = $this->buildSystemPrompt();
        $contents = $this->buildContents($userMessage, $chatHistory, $systemPrompt);

        try {
            $response = Http::timeout(15)
                ->retry(1, 500)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post("{$this->baseUrl}/models/{$this->model}:generateContent?key={$this->apiKey}", [
                    'contents' => $contents,
                    'generationConfig' => [
                        'temperature' => 0.7,
                        'maxOutputTokens' => 1024,
                    ],
                ]);

            if ($response->successful()) {
                $data = $response->json();
                $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;

                if ($text) {
                    return $text;
                }
            }

            Log::warning('Gemini API error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return $this->getFallbackReply($userMessage);
        } catch (\Exception $e) {
            Log::error('Gemini API exception', ['message' => $e->getMessage()]);
            return $this->getFallbackReply($userMessage);
        }
    }

    protected function buildSystemPrompt(): string
    {
        $profil = ProfilSekolah::first();
        $faqs = Faq::where('status', true)->orderBy('urutan')->get(['pertanyaan', 'jawaban']);
        $jadwals = JadwalPpdb::orderBy('urutan')->get(['kegiatan', 'tanggal_mulai', 'tanggal_selesai']);
        $jalurs = JalurPendaftaran::where('status', true)->get(['nama', 'kuota', 'deskripsi']);
        $pengumumans = Pengumuman::where('status', true)->latest()->take(5)->get(['judul', 'isi']);
        $tahapans = TahapanPpdb::orderBy('urutan')->get(['judul', 'deskripsi']);
        $periode = PeriodePpdb::where('status_aktif', true)->first();
        $persyaratan = PersyaratanDokumen::where('status', true)->orderBy('urutan')->get(['nama', 'keterangan', 'format', 'is_wajib', 'kategori']);

        $namaSekolah = $profil->nama_sekolah ?? 'ini';
        $prompt = "Kamu adalah asisten virtual PPDB (Penerimaan Peserta Didik Baru) untuk sekolah {$namaSekolah}. ";
        $prompt .= "Tugasmu membantu calon siswa/wali murih pertanyaan seputar pendaftaran, persyaratan, jadwal, dan informasi sekolah. ";
        $prompt .= "Jawab dengan ramah, singkat, dan akurat dalam Bahasa Indonesia. ";
        $prompt .= "Jika pertanyaan di luar konteks PPDB, arahkan kembali ke topik PPDB. ";
        $prompt .= "Jika kamu tidak yakin dengan jawaban, sarankan untuk menghubungi admin.\n\n";

        if ($profil) {
            $prompt .= "=== INFORMASI SEKOLAH ===\n";
            $prompt .= "Nama: {$profil->nama_sekolah}\n";
            $prompt .= "NPSN: {$profil->npsn}\n";
            $prompt .= "Alamat: {$profil->alamat}, {$profil->kota}, {$profil->provinsi}\n";
            $prompt .= "Telepon: {$profil->telepon}\n";
            $prompt .= "Email: {$profil->email}\n";
            $prompt .= "WhatsApp: {$profil->whatsapp}\n\n";
        }

        if ($periode) {
            $prompt .= "=== PERIODE PPDB AKTIF ===\n";
            $prompt .= "Nama: {$periode->nama}\n";
            $prompt .= "Tanggal: {$periode->tanggal_mulai} s/d {$periode->tanggal_selesai}\n\n";
        }

        if ($jadwals->isNotEmpty()) {
            $prompt .= "=== JADWAL PPDB ===\n";
            foreach ($jadwals as $j) {
                $mulai = \Carbon\Carbon::parse($j->tanggal_mulai)->format('d/m/Y');
                $selesai = \Carbon\Carbon::parse($j->tanggal_selesai)->format('d/m/Y');
                $prompt .= "- {$j->kegiatan}: {$mulai} s/d {$selesai}\n";
            }
            $prompt .= "\n";
        }

        if ($tahapans->isNotEmpty()) {
            $prompt .= "=== TAHAPAN PPDB ===\n";
            foreach ($tahapans as $t) {
                $prompt .= "- {$t->judul}: {$t->deskripsi}\n";
            }
            $prompt .= "\n";
        }

        if ($jalurs->isNotEmpty()) {
            $prompt .= "=== JALUR PENDAFTARAN ===\n";
            foreach ($jalurs as $j) {
                $prompt .= "- {$j->nama} (Kuota: {$j->kuota}): {$j->deskripsi}\n";
            }
            $prompt .= "\n";
        }

        if ($persyaratan->isNotEmpty()) {
            $prompt .= "=== PERSYARATAN DOKUMEN ===\n";
            foreach ($persyaratan as $p) {
                $wajib = $p->is_wajib ? 'Wajib' : 'Opsional';
                $prompt .= "- {$p->nama} [{$wajib}] (Format: {$p->format}): {$p->keterangan}\n";
            }
            $prompt .= "\n";
        }

        if ($faqs->isNotEmpty()) {
            $prompt .= "=== FAQ (PERTANYAAN UMUM) ===\n";
            foreach ($faqs as $f) {
                $prompt .= "Q: {$f->pertanyaan}\nA: {$f->jawaban}\n\n";
            }
        }

        if ($pengumumans->isNotEmpty()) {
            $prompt .= "=== PENGUMUMAN TERBARU ===\n";
            foreach ($pengumumans as $p) {
                $isi = strip_tags($p->isi);
                $prompt .= "- {$p->judul}: " . mb_substr($isi, 0, 200) . "\n";
            }
            $prompt .= "\n";
        }

        $prompt .= "=== INSTRUKSI TAMBAHAN ===\n";
        $prompt .= "- Sapa pengguna dengan ramah\n";
        $prompt .= "- Jika ditanya cara mendaftar, jelaskan alur: Biodata → Orang Tua → Sekolah Asal → Pilih Jalur → Upload Dokumen → Submit\n";
        $prompt .= "- Jika ditanya tentang status pendaftaran, arahkan untuk login dan melihat dashboard\n";
        $prompt .= "- Jika ditanya hal di luar kemampuanmu, sarankan menghubungi admin via WhatsApp atau halaman kontak\n";

        return $prompt;
    }

    protected function buildContents(string $userMessage, array $chatHistory, string $systemPrompt): array
    {
        $contents = [];

        $contents[] = [
            'role' => 'user',
            'parts' => [['text' => $systemPrompt]],
        ];
        $contents[] = [
            'role' => 'model',
            'parts' => [['text' => 'Baik, saya mengerti. Saya adalah asisten virtual PPDB yang siap membantu. Silakan tanyakan apa saja seputar pendaftaran siswa baru!']],
        ];

        foreach ($chatHistory as $msg) {
            $contents[] = [
                'role' => $msg['sender_type'] === 'user' ? 'user' : 'model',
                'parts' => [['text' => $msg['body']]],
            ];
        }

        $contents[] = [
            'role' => 'user',
            'parts' => [['text' => $userMessage]],
        ];

        return $contents;
    }

    protected function getFallbackReply(string $userMessage): string
    {
        $message = strtolower($userMessage);

        if (str_contains($message, 'halo') || str_contains($message, 'hai') || str_contains($message, 'hi') || str_contains($message, 'selamat')) {
            $profil = ProfilSekolah::first();
            $nama = $profil->nama_sekolah ?? 'sekolah kami';
            return "Halo! Selamat datang di asisten virtual PPDB {$nama}. Ada yang bisa saya bantu seputar pendaftaran siswa baru? 😊";
        }

        if (str_contains($message, 'cara daftar') || str_contains($message, 'gimana cara') || str_contains($message, 'bagaimana cara')) {
            return "Untuk mendaftar PPDB, silakan ikuti langkah berikut:\n\n1️⃣ Isi Biodata Diri\n2️⃣ Isi Data Orang Tua\n3️⃣ Isi Sekolah Asal\n4️⃣ Pilih Jalur Pendaftaran\n5️⃣ Upload Dokumen Persyaratan\n6️⃣ Submit Pendaftaran\n\nSemua langkah bisa dilakukan dari dashboard Anda. Semangat! 💪";
        }

        if (str_contains($message, 'jadwal') || str_contains($message, 'tanggal')) {
            $jadwals = JadwalPpdb::orderBy('urutan')->get();
            if ($jadwals->isEmpty()) {
                return "Untuk jadwal terbaru PPDB, silakan cek halaman Pengumuman atau hubungi admin sekolah. 📅";
            }
            $text = "Berikut jadwal PPDB:\n\n";
            foreach ($jadwals as $j) {
                $mulai = \Carbon\Carbon::parse($j->tanggal_mulai)->format('d/m/Y');
                $selesai = \Carbon\Carbon::parse($j->tanggal_selesai)->format('d/m/Y');
                $text .= "• {$j->kegiatan}: {$mulai} - {$selesai}\n";
            }
            return $text;
        }

        if (str_contains($message, 'jalur') || str_contains($message, 'kuota')) {
            $jalurs = JalurPendaftaran::where('status', true)->get();
            if ($jalurs->isEmpty()) {
                return "Informasi jalur pendaftaran akan segera diumumkan. Silakan pantau halaman Pengumuman. 📢";
            }
            $text = "Jalur pendaftaran yang tersedia:\n\n";
            foreach ($jalurs as $j) {
                $text .= "• {$j->nama} (Kuota: {$j->kuota})\n  {$j->deskripsi}\n\n";
            }
            return $text;
        }

        if (str_contains($message, 'dokumen') || str_contains($message, 'persyaratan') || str_contains($message, 'berkas')) {
            $persyaratan = PersyaratanDokumen::where('status', true)->orderBy('urutan')->get();
            if ($persyaratan->isEmpty()) {
                return "Persyaratan dokumen akan segera diinformasikan. Silakan hubungi admin untuk info lebih lanjut. 📄";
            }
            $text = "Dokumen yang diperlukan:\n\n";
            foreach ($persyaratan as $p) {
                $wajib = $p->is_wajib ? '✓ Wajib' : '○ Opsional';
                $text .= "• {$p->nama} [{$wajib}] (Format: {$p->format})\n";
            }
            return $text;
        }

        if (str_contains($message, 'pengumuman') || str_contains($message, 'berita')) {
            $pengumumans = Pengumuman::where('status', true)->latest()->take(3)->get();
            if ($pengumumans->isEmpty()) {
                return "Belum ada pengumuman terbaru saat ini. Silakan cek kembali nanti. 📢";
            }
            $text = "Pengumuman terbaru:\n\n";
            foreach ($pengumumans as $p) {
                $text .= "• {$p->judul}\n";
            }
            $text .= "\nSelengkapnya bisa dilihat di halaman Pengumuman.";
            return $text;
        }

        if (str_contains($message, 'hubungi') || str_contains($message, 'kontak') || str_contains($message, 'telepon') || str_contains($message, 'wa')) {
            $profil = ProfilSekolah::first();
            if ($profil) {
                $text = "Anda bisa menghubungi sekolah melalui:\n\n";
                if ($profil->telepon) $text .= "📞 Telepon: {$profil->telepon}\n";
                if ($profil->whatsapp) $text .= "📱 WhatsApp: {$profil->whatsapp}\n";
                if ($profil->email) $text .= "✉️ Email: {$profil->email}\n";
                if ($profil->alamat) $text .= "📍 Alamat: {$profil->alamat}\n";
                return $text;
            }
            return "Silakan hubungi admin sekolah untuk informasi lebih lanjut. 📞";
        }

        if (str_contains($message, 'terima kasih') || str_contains($message, 'makasih') || str_contains($message, 'thanks')) {
            return "Sama-sama! Senang bisa membantu. Jika ada pertanyaan lain, jangan ragu untuk bertanya ya! 😊";
        }

        return "Maaf, saya belum bisa menjawab pertanyaan tersebut dengan tepat. Untuk bantuan lebih lanjut, silakan hubungi admin sekolah atau kirim pesan di chat ini agar admin dapat membantu Anda. 🙏";
    }
}
