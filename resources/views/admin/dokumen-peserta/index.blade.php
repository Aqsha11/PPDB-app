<x-app-layout>
    <x-slot name="header">Dokumen Peserta</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Dokumen Peserta'],
        ]" />

        <x-admin.module-header title="Dokumen Peserta" description="Lihat semua dokumen yang telah diunggah peserta. Pantau status verifikasi dan kelengkapan dokumen pendaftaran.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <div class="p-4 border-b border-gray-100 dark:border-slate-700">
                <form method="GET" action="{{ route('admin.dokumen-peserta.index') }}" class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
                    <div class="relative w-full sm:w-72">
                        <svg class="w-4 h-4 text-gray-400 dark:text-slate-500 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" name="search" placeholder="Cari nama peserta atau NISN..." value="{{ request('search') }}"
                            class="w-full pl-9 pr-3 py-2.5 text-sm border-0 rounded-xl bg-gray-50 dark:bg-slate-700/50 text-gray-700 dark:text-slate-200 placeholder-gray-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-slate-600 transition-all">
                    </div>
                    <div class="flex items-center gap-2">
                        <x-primary-button type="submit">Cari</x-primary-button>
                        @if(request('search'))
                            <x-secondary-button href="{{ route('admin.dokumen-peserta.index') }}">Reset</x-secondary-button>
                        @endif
                    </div>
                </form>
            </div>

            <x-table :headers="['No', 'Nama Peserta', 'NISN', 'Jumlah Dokumen', 'Status Verifikasi', 'Aksi']">
                @forelse($pendaftarans as $p)
                    @php
                        $peserta = $p->peserta;
                        $docs = $p->dokumenPendaftarans;
                        $total = $docs->count();
                        $verified = $docs->where('status', 'terverifikasi')->count();
                        $rejected = $docs->where('status', 'ditolak')->count();
                        $pending = $docs->where('status', 'pending')->count();
                    @endphp
                    <tr class="border-b border-gray-100 dark:border-slate-700/50 hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                        <td class="px-5 py-3.5 text-sm text-gray-500">{{ $loop->iteration }}</td>
                        <td class="px-5 py-3.5 text-sm font-medium text-gray-900 dark:text-white">
                            {{ $peserta->nama_lengkap ?? $p->user->name ?? '-' }}
                        </td>
                        <td class="px-5 py-3.5 text-sm text-gray-500 dark:text-slate-400">{{ $peserta->nisn ?? '-' }}</td>
                        <td class="px-5 py-3.5 text-sm text-gray-500 dark:text-slate-400">
                            <span class="font-semibold">{{ $total }}</span> file
                            <span class="text-xs text-gray-400 ml-1">
                                (@if($verified > 0)<span class="text-emerald-600">{{ $verified }} verified</span>@endif
                                @if($pending > 0)<span class="text-amber-600">{{ $pending }} pending</span>@endif
                                @if($rejected > 0)<span class="text-red-600">{{ $rejected }} ditolak</span>@endif)
                            </span>
                        </td>
                        <td class="px-5 py-3.5">
                            @if($rejected > 0)
                                <x-badge color="red">Ada Ditolak</x-badge>
                            @elseif($pending > 0)
                                <x-badge color="yellow">Sebagian Pending</x-badge>
                            @else
                                <x-badge color="green">Semua Terverifikasi</x-badge>
                            @endif
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-1">
                                <x-icon-button :href="route('admin.dokumen-peserta.show', $p->id)" variant="primary" title="Lihat Detail">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </x-icon-button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-12">
                            <x-empty-state title="Belum ada dokumen" description="Dokumen peserta akan muncul setelah pengguna mengunggah persyaratan." />
                        </td>
                    </tr>
                @endforelse
            </x-table>

            @if(method_exists($pendaftarans, 'links'))
                <div class="px-5 py-4 border-t border-gray-100 dark:border-slate-700">
                    {{ $pendaftarans->links() }}
                </div>
            @endif
        </x-card>
    </div>
</x-app-layout>
