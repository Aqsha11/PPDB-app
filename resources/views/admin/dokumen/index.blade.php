<x-app-layout>
    <x-slot name="header">Persyaratan Dokumen</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Persyaratan Dokumen'],
        ]" />

        <x-admin.module-header title="Persyaratan Dokumen" description="Kelola daftar dokumen yang wajib atau opsional untuk pendaftaran PPDB.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </x-slot>
            <x-slot name="actions">
                <x-primary-button href="{{ route('admin.dokumen-persyaratan.create') }}">
                    + Tambah Dokumen
                </x-primary-button>
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <x-table :headers="['No', 'Nama Dokumen', 'Kategori', 'Wajib', 'Urutan', 'Status', 'Aksi']">
                @forelse($data as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $item->nama }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $item->kategori ?? '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($item->is_wajib)
                                <x-badge color="red">Wajib</x-badge>
                            @else
                                <x-badge color="gray">Opsional</x-badge>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $item->urutan ?? 0 }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('admin.dokumen-persyaratan.toggle-status', $item->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold transition-colors {{ $item->status ? 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $item->status ? 'bg-emerald-500' : 'bg-gray-400' }}"></span>
                                    {{ $item->status ? 'Aktif' : 'Nonaktif' }}
                                </button>
                            </form>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end gap-1">
                                <x-icon-button :href="route('admin.dokumen-persyaratan.edit', $item)" variant="warning" title="Ubah">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </x-icon-button>
                                <x-icon-button :delete="true" :href="route('admin.dokumen-persyaratan.destroy', $item)" title="Hapus" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <x-empty-state title="Belum ada persyaratan dokumen" description="Tambahkan persyaratan dokumen baru." />
                        </td>
                    </tr>
                @endforelse
            </x-table>
        </x-card>
    </div>
</x-app-layout>
