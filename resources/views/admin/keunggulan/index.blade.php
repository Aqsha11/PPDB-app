<x-app-layout>
    <x-slot name="header">Keunggulan Sekolah</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Keunggulan'],
        ]" />

        <x-admin.module-header title="Keunggulan Sekolah" description="Kelola daftar keunggulan sekolah yang ditampilkan di halaman publik.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
            </x-slot>
            <x-slot name="actions">
                <x-primary-button href="{{ route('admin.keunggulan.create') }}">
                    + Tambah Keunggulan
                </x-primary-button>
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <x-table :headers="['No', 'Judul', 'Deskripsi', 'Urutan', 'Aksi']">
                @forelse($data as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $item->judul }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 max-w-xs truncate">
                            {{ Str::limit($item->deskripsi, 60) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $item->urutan ?? '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end gap-1">
                                <x-icon-button :href="route('admin.keunggulan.edit', $item)" variant="warning" title="Ubah">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </x-icon-button>
                                <x-icon-button :delete="true" :href="route('admin.keunggulan.destroy', $item)" title="Hapus" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <x-empty-state title="Belum ada keunggulan" description="Tambahkan keunggulan sekolah baru." />
                        </td>
                    </tr>
                @endforelse
            </x-table>
        </x-card>
    </div>
</x-app-layout>
