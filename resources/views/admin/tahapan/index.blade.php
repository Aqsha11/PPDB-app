<x-app-layout>
    <x-slot name="header">Tahapan PPDB</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Tahapan PPDB'],
        ]" />

        <x-admin.module-header title="Tahapan PPDB" description="Kelola tahapan-tahapan dalam proses pendaftaran PPDB. Atur urutan, nama, dan deskripsi setiap tahapan.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
            </x-slot>
            <x-slot name="actions">
                <x-primary-button href="{{ route('admin.tahapan.create') }}">
                    + Tambah Tahapan
                </x-primary-button>
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <x-table :headers="['No', 'Nama Tahapan', 'Deskripsi', 'Urutan', 'Status Aktif', 'Aksi']">
                @forelse($data as $item)
                    <tr class="border-b border-gray-100 dark:border-slate-700/50 hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                        <td class="px-5 py-3.5 text-sm text-gray-500">{{ $loop->iteration }}</td>
                        <td class="px-5 py-3.5 text-sm font-medium text-gray-900 dark:text-white">{{ $item->judul }}</td>
                        <td class="px-5 py-3.5 text-sm text-gray-500 dark:text-slate-400 max-w-xs truncate">{{ Str::limit($item->deskripsi, 80) }}</td>
                        <td class="px-5 py-3.5 text-sm text-gray-500 dark:text-slate-400">{{ $item->urutan ?? $loop->iteration }}</td>
                        <td class="px-5 py-3.5">
                            @if($item->status ?? true)
                                <x-badge color="green">Aktif</x-badge>
                            @else
                                <x-badge color="red">Nonaktif</x-badge>
                            @endif
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-1">
                                <x-icon-button :href="route('admin.tahapan.edit', $item->id)" variant="warning" title="Ubah">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </x-icon-button>
                                <x-icon-button :href="route('admin.tahapan.destroy', $item->id)" variant="danger" title="Hapus" :delete="true" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-12">
                            <x-empty-state title="Belum ada tahapan" description="Tambahkan tahapan pendaftaran PPDB">
                                <x-slot name="action">
                                    <x-primary-button href="{{ route('admin.tahapan.create') }}">+ Tambah Tahapan</x-primary-button>
                                </x-slot>
                            </x-empty-state>
                        </td>
                    </tr>
                @endforelse
            </x-table>
        </x-card>
    </div>
</x-app-layout>
