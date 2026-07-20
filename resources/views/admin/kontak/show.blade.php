<x-app-layout>
    <x-slot name="header">Detail Pesan</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Pesan Masuk', 'url' => route('admin.kontak.index')],
            ['label' => 'Detail Pesan'],
        ]" />

        <x-admin.module-header title="Detail Pesan" description="Pesan dari {{ $data->nama }} melalui formulir kontak publik.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-white text-sm font-bold" style="background-color: var(--warna-primary)">
                            {{ substr($data->nama, 0, 1) }}
                        </div>
                        <div>
                            <p class="font-bold text-gray-900 dark:text-white">{{ $data->nama }}</p>
                            <p class="text-sm text-gray-500 dark:text-slate-400">{{ $data->email }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <x-icon-button :href="route('admin.kontak.destroy', $data->id)" variant="danger" title="Hapus" :delete="true">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </x-icon-button>
                    </div>
                </div>

                <div class="border-t border-gray-100 dark:border-slate-700 pt-5">
                    <div class="grid sm:grid-cols-3 gap-4 text-sm">
                        <div>
                            <span class="text-gray-500 dark:text-slate-400">Telepon</span>
                            <p class="font-medium text-gray-900 dark:text-white mt-1">{{ $data->telepon ?? '-' }}</p>
                        </div>
                        <div>
                            <span class="text-gray-500 dark:text-slate-400">Subjek</span>
                            <p class="font-medium text-gray-900 dark:text-white mt-1">{{ $data->subjek ?? '-' }}</p>
                        </div>
                        <div>
                            <span class="text-gray-500 dark:text-slate-400">Tanggal</span>
                            <p class="font-medium text-gray-900 dark:text-white mt-1">{{ $data->created_at->translatedFormat('d F Y, H:i') }}</p>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-100 dark:border-slate-700 pt-5">
                    <span class="text-sm text-gray-500 dark:text-slate-400 block mb-2">Pesan</span>
                    <div class="bg-gray-50 dark:bg-slate-700/50 rounded-xl p-5 text-sm text-gray-700 dark:text-slate-300 leading-relaxed whitespace-pre-wrap">{{ $data->pesan }}</div>
                </div>

                <div class="border-t border-gray-100 dark:border-slate-700 pt-5">
                    <a href="mailto:{{ $data->email }}?subject=Re: {{ $data->subjek ?? 'Pesan dari ' . $data->nama }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition-colors" style="background-color: color-mix(in srgb, var(--warna-primary) 10%, transparent); color: var(--warna-primary)">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Balas via Email
                    </a>
                </div>
            </div>
        </x-card>
    </div>
</x-app-layout>
