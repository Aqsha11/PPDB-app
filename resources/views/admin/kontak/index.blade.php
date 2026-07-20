<x-app-layout>
    <x-slot name="header">Pesan Masuk</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Pesan Masuk'],
        ]" />

        <x-admin.module-header title="Pesan Masuk" description="Lihat dan kelola pesan masuk dari formulir kontak halaman publik. Balas atau hapus pesan yang sudah tidak diperlukan.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <x-table :headers="['No', 'Nama', 'Email', 'Subjek', 'Pesan', 'Tanggal', 'Aksi']">
                @forelse($data as $item)
                    <tr class="border-b border-gray-100 dark:border-slate-700/50 hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                        <td class="px-5 py-3.5 text-sm text-gray-500">{{ $loop->iteration }}</td>
                        <td class="px-5 py-3.5 text-sm font-medium text-gray-900 dark:text-white">
                            @unless($item->is_read)
                                <span class="inline-block w-2 h-2 rounded-full bg-red-500 mr-1.5"></span>
                            @endunless
                            {{ $item->nama ?? '-' }}
                        </td>
                        <td class="px-5 py-3.5 text-sm text-gray-500 dark:text-slate-400">{{ $item->email ?? '-' }}</td>
                        <td class="px-5 py-3.5 text-sm text-gray-500 dark:text-slate-400">{{ $item->subjek ?? '-' }}</td>
                        <td class="px-5 py-3.5 text-sm text-gray-500 dark:text-slate-400 max-w-xs truncate">{{ Str::limit($item->pesan ?? '', 60) }}</td>
                        <td class="px-5 py-3.5 text-sm text-gray-500 dark:text-slate-400 whitespace-nowrap">{{ $item->created_at->format('d/m/Y') }}</td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-1">
                                <x-icon-button :href="route('admin.kontak.show', $item->id)" variant="primary" title="Lihat">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </x-icon-button>
                                <x-icon-button :href="route('admin.kontak.destroy', $item->id)" variant="danger" title="Hapus" :delete="true" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-5 py-12">
                            <x-empty-state title="Belum ada pesan" description="Pesan dari formulir kontak akan muncul di sini." />
                        </td>
                    </tr>
                @endforelse
            </x-table>
        </x-card>
    </div>
</x-app-layout>
