<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cetak Bukti Pendaftaran - {{ $pendaftaran->nomor_pendaftaran }}</title>
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f3f4f6; }
        .card { background: white; max-width: 800px; margin: 20px auto; padding: 40px; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .header { text-align: center; border-bottom: 2px solid #e5e7eb; padding-bottom: 20px; margin-bottom: 24px; }
        .header h1 { font-size: 18px; font-weight: 700; color: #111827; }
        .header p { font-size: 13px; color: #6b7280; margin-top: 4px; }
        .title { text-align: center; font-size: 16px; font-weight: 700; color: #1d4ed8; margin-bottom: 24px; text-transform: uppercase; letter-spacing: 1px; }
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 24px; }
        .info-item { display: flex; gap: 8px; }
        .info-label { font-size: 12px; color: #6b7280; min-width: 120px; }
        .info-value { font-size: 12px; font-weight: 600; color: #111827; }
        .section-title { font-size: 13px; font-weight: 700; color: #374151; margin: 20px 0 12px; padding-bottom: 8px; border-bottom: 1px solid #e5e7eb; }
        .doc-list { list-style: none; }
        .doc-list li { font-size: 12px; color: #374151; padding: 4px 0; display: flex; align-items: center; gap: 8px; }
        .doc-list li::before { content: "✓"; color: #059669; font-weight: 700; }
        .footer { text-align: center; margin-top: 30px; padding-top: 20px; border-top: 2px solid #e5e7eb; }
        .footer p { font-size: 11px; color: #9ca3af; }
        .print-btn { display: block; max-width: 800px; margin: 20px auto; text-align: center; }
        .print-btn button { background: #2563eb; color: white; border: none; padding: 10px 24px; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; }
        .print-btn button:hover { background: #1d4ed8; }
        @media print {
            body { background: white; }
            .card { box-shadow: none; margin: 0; border-radius: 0; }
            .print-btn { display: none !important; }
        }
    </style>
</head>
<body>
    <div class="print-btn">
        <button onclick="window.print()">Cetak Bukti Pendaftaran</button>
    </div>

    <div class="card">
        <div class="header">
            @if(isset($profil) && $profil?->logo)
                <img src="{{ Storage::url($profil->logo) }}" alt="Logo" style="height: 60px; margin: 0 auto 12px;">
            @endif
            <h1>{{ $profil->nama_sekolah ?? config('app.name', 'PPDB') }}</h1>
            <p>{{ $profil->alamat ?? '' }}</p>
        </div>

        <div class="title">Bukti Pendaftaran PPDB</div>

        <div class="info-grid">
            <div>
                <div class="info-item">
                    <span class="info-label">No. Pendaftaran</span>
                    <span class="info-value">: {{ $pendaftaran->nomor_pendaftaran }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Nama Lengkap</span>
                    <span class="info-value">: {{ $peserta->nama_lengkap }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">NISN</span>
                    <span class="info-value">: {{ $peserta->nisn ?? '-' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">NIK</span>
                    <span class="info-value">: {{ $peserta->nik ?? '-' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Tanggal Lahir</span>
                    <span class="info-value">: {{ $peserta->tanggal_lahir?->format('d/m/Y') ?? '-' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Jenis Kelamin</span>
                    <span class="info-value">: {{ $peserta->jenis_kelamin ?? '-' }}</span>
                </div>
            </div>
            <div>
                <div class="info-item">
                    <span class="info-label">Jalur</span>
                    <span class="info-value">: {{ $pendaftaran->jalurPendaftaran?->nama ?? '-' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Tahun Ajaran</span>
                    <span class="info-value">: {{ $pendaftaran->periodePpdb?->tahunAjaran?->tahun ?? '-' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Status</span>
                    <span class="info-value">: {{ ucfirst($pendaftaran->status_pendaftaran) }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Tanggal Daftar</span>
                    <span class="info-value">: {{ $pendaftaran->created_at?->format('d/m/Y H:i') ?? '-' }}</span>
                </div>
                @if($pendaftaran->tanggal_submit)
                    <div class="info-item">
                        <span class="info-label">Tanggal Submit</span>
                        <span class="info-value">: {{ $pendaftaran->tanggal_submit?->format('d/m/Y H:i') }}</span>
                    </div>
                @endif
            </div>
        </div>

        @if($pendaftaran->dokumenPendaftarans->count() > 0)
            <div class="section-title">Dokumen Terupload</div>
            <ul class="doc-list">
                @foreach($pendaftaran->dokumenPendaftarans as $dok)
                    <li>{{ $dok->persyaratanDokumen?->nama ?? 'Dokumen' }}</li>
                @endforeach
            </ul>
        @endif

        <div class="footer">
            <p>Dokumen ini dicetak secara otomatis dari sistem PPDB Online</p>
            <p>{{ $profil->nama_sekolah ?? config('app.name') }} &copy; {{ date('Y') }}</p>
        </div>
    </div>
</body>
</html>
