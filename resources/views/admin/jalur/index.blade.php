<x-app-layout>
    <x-slot name="header">Jalur Pendaftaran</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Jalur Pendaftaran'],
        ]" />

        <x-admin.module-header title="Jalur Pendaftaran" description="Kelola jalur pendaftaran seperti Umum, Prestasi, atau Jalur Khusus.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
            </x-slot>
            <x-slot name="actions">
                <x-primary-button href="{{ route('admin.jalur.create') }}">
                    + Tambah Jalur
                </x-primary-button>
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <x-table :headers="['No', 'Nama Jalur', 'Kuota', 'Status', 'Aksi']">
                @forelse($data as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $item->nama_jalur }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $item->kuota }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('admin.jalur.toggle-status', $item->id) }}" method="POST" class="inline">
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
                                <x-icon-button :href="route('admin.jalur.edit', $item)" variant="warning" title="Ubah">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </x-icon-button>
                                <x-icon-button :delete="true" :href="route('admin.jalur.destroy', $item)" title="Hapus" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <x-empty-state title="Belum ada jalur pendaftaran" description="Tambahkan jalur pendaftaran baru." />
                        </td>
                    </tr>
                @endforelse
            </x-table>
        </x-card>
    </div>
</x-app-layout>
