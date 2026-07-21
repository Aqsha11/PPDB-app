<x-app-layout>
    <x-slot name="header">Detail Dokumen Peserta</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Dokumen Peserta', 'url' => route('admin.dokumen-peserta.index')],
            ['label' => $dokumenPeserta->peserta->nama_lengkap ?? 'Detail'],
        ]" />

        <div class="flex items-center justify-between">
            <x-icon-button :href="route('admin.dokumen-peserta.index')" variant="default" title="Kembali">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </x-icon-button>
        </div>

        {{-- Info Peserta --}}
        <x-card title="Informasi Peserta">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <p class="text-xs font-medium text-gray-400 dark:text-slate-500 uppercase tracking-wider">Nama Lengkap</p>
                    <p class="mt-1 text-sm font-semibold text-gray-900 dark:text-white">{{ $dokumenPeserta->peserta->nama_lengkap ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-400 dark:text-slate-500 uppercase tracking-wider">NISN</p>
                    <p class="mt-1 text-sm font-semibold text-gray-900 dark:text-white">{{ $dokumenPeserta->peserta->nisn ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-400 dark:text-slate-500 uppercase tracking-wider">No. Pendaftaran</p>
                    <p class="mt-1 text-sm font-semibold text-gray-900 dark:text-white">{{ $dokumenPeserta->nomor_pendaftaran ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-400 dark:text-slate-500 uppercase tracking-wider">Jalur</p>
                    <p class="mt-1 text-sm font-semibold text-gray-900 dark:text-white">{{ $dokumenPeserta->jalurPendaftaran->nama ?? '-' }}</p>
                </div>
            </div>
        </x-card>

        {{-- Daftar Dokumen --}}
        <x-card title="Semua Dokumen ({{ $dokumenPeserta->dokumenPendaftarans->count() }} file)">
            @php
                $docs = $dokumenPeserta->dokumenPendaftarans->sortBy('persyaratanDokumen.urutan');
            @endphp

            @forelse($docs as $doc)
                @php
                    $ext = strtolower(pathinfo($doc->file, PATHINFO_EXTENSION));
                    $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                @endphp
                <div class="py-5 {{ !$loop->last ? 'border-b border-gray-100 dark:border-slate-700' : '' }} first:pt-0 last:pb-0">
                    <div class="flex flex-col lg:flex-row lg:items-start gap-4">
                        {{-- Info Dokumen --}}
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 flex-wrap">
                                <h4 class="text-sm font-bold text-gray-900 dark:text-white">{{ $doc->persyaratanDokumen->nama ?? 'Dokumen' }}</h4>
                                @if($doc->persyaratanDokumen->is_wajib ?? false)
                                    <x-badge color="red">Wajib</x-badge>
                                @else
                                    <x-badge color="gray">Opsional</x-badge>
                                @endif
                                @if($doc->status === 'terverifikasi')
                                    <x-badge color="green">Terverifikasi</x-badge>
                                @elseif($doc->status === 'ditolak')
                                    <x-badge color="red">Ditolak</x-badge>
                                @else
                                    <x-badge color="yellow">Pending</x-badge>
                                @endif
                            </div>

                            @if($doc->catatan)
                                <p class="mt-1.5 text-xs text-gray-500 dark:text-slate-400 italic">Catatan: {{ $doc->catatan }}</p>
                            @endif

                            @if($doc->verified_at)
                                <p class="mt-1 text-xs text-gray-400 dark:text-slate-500">Diverifikasi: {{ $doc->verified_at->format('d/m/Y H:i') }}</p>
                            @endif
                        </div>

                        {{-- Preview & Aksi --}}
                        <div class="shrink-0 flex items-center gap-2">
                            @if($isImage)
                                <a href="{{ Storage::url($doc->file) }}" target="_blank" class="shrink-0">
                                    <img src="{{ Storage::url($doc->file) }}" alt="{{ $doc->persyaratanDokumen->nama }}" class="w-16 h-16 rounded-lg object-cover border border-gray-200 dark:border-slate-600">
                                </a>
                            @endif
                            <a href="{{ Storage::url($doc->file) }}" target="_blank"
                               class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold rounded-lg theme-bg-light theme-text hover:opacity-80 transition">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                Lihat
                            </a>
                            <form method="POST" action="{{ route('admin.dokumen-peserta.destroy', $doc->id) }}" onsubmit="return confirm('Hapus dokumen ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold rounded-lg bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-500/20 transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-8">
                    <p class="text-sm text-gray-500 dark:text-slate-400">Belum ada dokumen diunggah.</p>
                </div>
            @endforelse
        </x-card>
    </div>
</x-app-layout>
