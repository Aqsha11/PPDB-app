<x-app-layout>
    <x-slot name="header">Jadwal PPDB</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Jadwal PPDB'],
        ]" />

        <x-admin.module-header title="Jadwal PPDB" description="Atur jadwal kegiatan PPDB seperti pendaftaran, verifikasi, seleksi, dan daftar ulang beserta periode waktunya.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </x-slot>
            <x-slot name="actions">
                <x-primary-button href="{{ route('admin.jadwal.create') }}">
                    + Tambah Jadwal
                </x-primary-button>
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <x-table :headers="['No', 'Kegiatan', 'Tgl Mulai', 'Tgl Selesai', 'Tahapan', 'Aksi']">
                @forelse($data as $item)
                    <tr class="border-b border-gray-100 dark:border-slate-700/50 hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                        <td class="px-5 py-3.5 text-sm text-gray-500">{{ $loop->iteration }}</td>
                        <td class="px-5 py-3.5 text-sm font-medium text-gray-900 dark:text-white">{{ $item->kegiatan }}</td>
                        <td class="px-5 py-3.5 text-sm text-gray-500 dark:text-slate-400 whitespace-nowrap">{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d/m/Y') }}</td>
                        <td class="px-5 py-3.5 text-sm text-gray-500 dark:text-slate-400 whitespace-nowrap">{{ $item->tanggal_selesai ? \Carbon\Carbon::parse($item->tanggal_selesai)->format('d/m/Y') : '-' }}</td>
                        <td class="px-5 py-3.5 text-sm text-gray-500 dark:text-slate-400">{{ $item->tahapan->nama ?? '-' }}</td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-1">
                                <x-icon-button :href="route('admin.jadwal.edit', $item->id)" variant="warning" title="Ubah">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </x-icon-button>
                                <x-icon-button :href="route('admin.jadwal.destroy', $item->id)" variant="danger" title="Hapus" :delete="true" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-12">
                            <x-empty-state title="Belum ada jadwal" description="Tambahkan jadwal kegiatan PPDB">
                                <x-slot name="action">
                                    <x-primary-button href="{{ route('admin.jadwal.create') }}">+ Tambah Jadwal</x-primary-button>
                                </x-slot>
                            </x-empty-state>
                        </td>
                    </tr>
                @endforelse
            </x-table>
        </x-card>
    </div>
</x-app-layout>
