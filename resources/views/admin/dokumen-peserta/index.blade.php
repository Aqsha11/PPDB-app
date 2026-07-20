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
            <x-table :headers="['No', 'Nama Peserta', 'Jenis Dokumen', 'Status', 'Aksi']">
                @forelse($data as $d)
                    <tr class="border-b border-gray-100 dark:border-slate-700/50 hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                        <td class="px-5 py-3.5 text-sm text-gray-500">{{ $loop->iteration }}</td>
                        <td class="px-5 py-3.5 text-sm font-medium text-gray-900 dark:text-white">{{ $d->pendaftaran->peserta->user->name ?? $d->pendaftaran->peserta->nama_lengkap ?? '-' }}</td>
                        <td class="px-5 py-3.5 text-sm text-gray-500 dark:text-slate-400">{{ $d->persyaratanDokumen->nama ?? '-' }}</td>
                        <td class="px-5 py-3.5">
                            @if($d->status === 'terverifikasi')
                                <x-badge color="green">Terverifikasi</x-badge>
                            @elseif($d->status === 'ditolak')
                                <x-badge color="red">Ditolak</x-badge>
                            @else
                                <x-badge color="yellow">Pending</x-badge>
                            @endif
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-1">
                                <x-icon-button :href="route('admin.dokumen-peserta.show', $d->id)" variant="primary" title="Lihat">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </x-icon-button>
                                <x-icon-button :href="route('admin.dokumen-peserta.destroy', $d->id)" variant="danger" title="Hapus" :delete="true" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-12">
                            <x-empty-state title="Belum ada dokumen" description="Dokumen peserta akan muncul setelah pengguna mengunggah persyaratan." />
                        </td>
                    </tr>
                @endforelse
            </x-table>

            @if(method_exists($data, 'links'))
                <div class="px-5 py-4 border-t border-gray-100 dark:border-slate-700">
                    {{ $data->links() }}
                </div>
            @endif
        </x-card>
    </div>
</x-app-layout>
