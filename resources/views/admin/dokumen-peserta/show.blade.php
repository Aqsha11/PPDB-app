<x-app-layout>
    <x-slot name="header">Detail Dokumen Peserta</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Dokumen Peserta', 'url' => route('admin.dokumen-peserta.index')],
            ['label' => 'Detail'],
        ]" />

        <div class="flex items-center justify-between">
            <x-icon-button :href="route('admin.dokumen-peserta.index')" variant="default" title="Kembali">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </x-icon-button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="space-y-6">
                <x-card title="Informasi Peserta">
                    <dl class="divide-y divide-gray-100 dark:divide-slate-700">
                        @foreach([
                            ['Nama Peserta', $dokumenPeserta->pendaftaran->peserta->user->name ?? $dokumenPeserta->pendaftaran->peserta->nama_lengkap ?? '-'],
                            ['NISN', $dokumenPeserta->pendaftaran->peserta->nisn ?? '-'],
                            ['Nomor Pendaftaran', $dokumenPeserta->pendaftaran->nomor_pendaftaran ?? '-'],
                        ] as [$label, $value])
                            <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">{{ $label }}</dt>
                                <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 dark:text-white">{{ $value }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </x-card>

                <x-card title="Informasi Dokumen">
                    <dl class="divide-y divide-gray-100 dark:divide-slate-700">
                        <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Nama Dokumen</dt>
                            <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 dark:text-white">{{ $dokumenPeserta->persyaratanDokumen->nama ?? '-' }}</dd>
                        </div>
                        <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Status Verifikasi</dt>
                            <dd class="mt-1 sm:mt-0 sm:col-span-2">
                                @if($dokumenPeserta->status === 'terverifikasi')
                                    <x-badge color="green">Terverifikasi</x-badge>
                                @elseif($dokumenPeserta->status === 'ditolak')
                                    <x-badge color="red">Ditolak</x-badge>
                                @else
                                    <x-badge color="yellow">Pending</x-badge>
                                @endif
                            </dd>
                        </div>
                        @if($dokumenPeserta->verified_at)
                            <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Tgl Verifikasi</dt>
                                <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 dark:text-white">{{ $dokumenPeserta->verified_at->format('d/m/Y H:i') }}</dd>
                            </div>
                        @endif
                        <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Keterangan</dt>
                            <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 dark:text-white">{{ $dokumenPeserta->catatan ?? '-' }}</dd>
                        </div>
                    </dl>
                </x-card>
            </div>

            <x-card title="File Dokumen">
                @if($dokumenPeserta->file)
                    @php
                        $ext = strtolower(pathinfo($dokumenPeserta->file, PATHINFO_EXTENSION));
                        $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                    @endphp
                    @if($isImage)
                        <div class="mb-4">
                            <img src="{{ Storage::url($dokumenPeserta->file) }}" alt="Dokumen" class="w-full rounded-lg border border-gray-200 dark:border-slate-600">
                        </div>
                    @else
                        <div class="mb-4 flex items-center justify-center p-8 bg-gray-50 dark:bg-slate-700 rounded-lg border border-gray-200 dark:border-slate-600">
                            <svg class="w-16 h-16 text-gray-400 dark:text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        </div>
                    @endif
                    <x-primary-button type="button" onclick="window.open('{{ Storage::url($dokumenPeserta->file) }}', '_blank')">
                        Download / Lihat File
                    </x-primary-button>
                @else
                    <p class="text-sm text-gray-500 dark:text-slate-400">File tidak tersedia.</p>
                @endif
            </x-card>
        </div>
    </div>
</x-app-layout>
