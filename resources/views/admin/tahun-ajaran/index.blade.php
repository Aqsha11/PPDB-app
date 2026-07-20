<x-app-layout>
    <x-slot name="header">Tahun Ajaran</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Tahun Ajaran'],
        ]" />

        <x-admin.module-header title="Tahun Ajaran" description="Kelola data tahun ajaran yang tersedia untuk pendaftaran PPDB.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </x-slot>
            <x-slot name="actions">
                <x-primary-button href="{{ route('admin.tahun-ajaran.create') }}">
                    + Tambah Tahun Ajaran
                </x-primary-button>
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <x-table :headers="['No', 'Nama Tahun Ajaran', 'Status', 'Aksi']">
                @forelse($data as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $item->tahun_awal }}/{{ $item->tahun_akhir }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('admin.tahun-ajaran.toggle-status', $item->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold transition-colors {{ $item->is_aktif ? 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $item->is_aktif ? 'bg-emerald-500' : 'bg-gray-400' }}"></span>
                                    {{ $item->is_aktif ? 'Aktif' : 'Nonaktif' }}
                                </button>
                            </form>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end gap-1">
                                <x-icon-button :href="route('admin.tahun-ajaran.edit', $item)" variant="warning" title="Ubah">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </x-icon-button>
                                <x-icon-button :delete="true" :href="route('admin.tahun-ajaran.destroy', $item)" title="Hapus" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <x-empty-state title="Belum ada tahun ajaran" description="Tambahkan tahun ajaran baru untuk memulai." />
                        </td>
                    </tr>
                @endforelse
            </x-table>
        </x-card>
    </div>
</x-app-layout>
