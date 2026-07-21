<x-app-layout>
    <div class="space-y-6">

        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'route' => 'admin.dashboard'],
            ['label' => 'Daftar Ulang', 'route' => 'admin.daftar-ulang.index'],
            ['label' => 'Detail'],
        ]" />

        <x-admin.module-header title="Detail Daftar Ulang" description="Data daftar ulang peserta." icon="<path stroke-linecap='round' stroke-linejoin='round' d='M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z' />">
            @slot('actions')
                <x-icon-button href="{{ route('admin.daftar-ulang.index') }}" variant="default" title="Kembali">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                </x-icon-button>
            @endslot
        </x-admin.module-header>

        <x-card title="Informasi Peserta">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <p class="text-xs font-bold text-gray-400 dark:text-slate-500 uppercase tracking-widest">Nama Lengkap</p>
                    <p class="mt-1 text-sm font-semibold text-gray-900 dark:text-white">{{ $daftarUlang->peserta->nama_lengkap ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 dark:text-slate-500 uppercase tracking-widest">NISN</p>
                    <p class="mt-1 text-sm font-semibold text-gray-900 dark:text-white">{{ $daftarUlang->peserta->nisn ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 dark:text-slate-500 uppercase tracking-widest">Email</p>
                    <p class="mt-1 text-sm font-semibold text-gray-900 dark:text-white">{{ $daftarUlang->peserta->user->email ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 dark:text-slate-500 uppercase tracking-widest">No. HP</p>
                    <p class="mt-1 text-sm font-semibold text-gray-900 dark:text-white">{{ $daftarUlang->peserta->no_hp ?? '-' }}</p>
                </div>
            </div>
        </x-card>

        <x-card title="Status Daftar Ulang">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <p class="text-xs font-bold text-gray-400 dark:text-slate-500 uppercase tracking-widest">Status</p>
                    <div class="mt-1">
                        @if($daftarUlang->daftarUlang && $daftarUlang->daftarUlang->status === 'sudah')
                            <x-badge color="green">Sudah Daftar Ulang</x-badge>
                        @else
                            <x-badge color="red">Belum</x-badge>
                        @endif
                    </div>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 dark:text-slate-500 uppercase tracking-widest">Tanggal</p>
                    <p class="mt-1 text-sm font-semibold text-gray-900 dark:text-white">
                        {{ $daftarUlang->daftarUlang?->tanggal_daftar_ulang ? $daftarUlang->daftarUlang->tanggal_daftar_ulang->setTimezone('Asia/Makassar')->format('d/m/Y H:i') . ' WITA' : '-' }}
                    </p>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 dark:text-slate-500 uppercase tracking-widest">Catatan</p>
                    <p class="mt-1 text-sm font-semibold text-gray-900 dark:text-white">{{ $daftarUlang->daftarUlang?->catatan ?? '-' }}</p>
                </div>
            </div>
        </x-card>

        @php
            $du = $daftarUlang->daftarUlang;
            $docs = [
                'bukti_kelulusan' => 'Bukti Kelulusan / Tanda Diterima',
                'fotokopi_kk' => 'Fotokopi Kartu Keluarga',
                'akta_kelahiran' => 'Akta Kelahiran',
                'ktp_orang_tua' => 'KTP Orang Tua',
                'skl_ijazah' => 'SKL / Ijazah',
            ];
        @endphp

        @if($du)
            <x-card title="Dokumen Daftar Ulang">
                <div class="space-y-3">
                    @foreach($docs as $field => $label)
                        <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-4 py-3 border-b border-gray-100 dark:border-slate-700 last:border-0">
                            <span class="text-xs font-bold text-gray-400 dark:text-slate-500 uppercase tracking-widest w-48 shrink-0">{{ $label }}</span>
                            <span class="text-sm text-gray-900 dark:text-white font-medium">
                                @if($du->$field)
                                    <a href="{{ Storage::url($du->$field) }}" target="_blank" class="theme-text hover:underline flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        Lihat File
                                    </a>
                                @else
                                    <span class="text-gray-400">Belum diunggah</span>
                                @endif
                            </span>
                        </div>
                    @endforeach
                </div>
            </x-card>
        @else
            <x-card>
                <div class="text-center py-8">
                    <p class="text-sm text-gray-500 dark:text-slate-400">Peserta belum melakukan daftar ulang.</p>
                </div>
            </x-card>
        @endif

    </div>
</x-app-layout>
