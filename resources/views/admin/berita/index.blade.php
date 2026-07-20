<x-app-layout>
    <x-slot name="header">Berita</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Berita'],
        ]" />

        <x-admin.module-header title="Berita & Artikel" description="Kelola berita, artikel, dan pengumuman yang ditampilkan di halaman publik. Publikasikan atau arsipkan konten.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15M9 11l3 3L22 4"/>
            </x-slot>
            <x-slot name="actions">
                <x-primary-button href="{{ route('admin.berita.create') }}">
                    + Tambah Berita
                </x-primary-button>
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <x-table :headers="['No', 'Judul', 'Penulis', 'Tanggal', 'Status Publish', 'Aksi']">
                @forelse($data as $item)
                    <tr class="border-b border-gray-100 dark:border-slate-700/50 hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                        <td class="px-5 py-3.5 text-sm text-gray-500">{{ $loop->iteration }}</td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                @if($item->thumbnail)
                                    <img src="{{ Storage::url($item->thumbnail) }}" class="w-12 h-9 object-cover rounded-lg border border-gray-200 dark:border-slate-600">
                                @else
                                    <div class="w-12 h-9 rounded-lg bg-gray-100 dark:bg-slate-700 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                @endif
                                <span class="text-sm font-medium text-gray-900 dark:text-white max-w-xs truncate">{{ $item->judul }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3.5 text-sm text-gray-500 dark:text-slate-400">{{ $item->penulis ?? '-' }}</td>
                        <td class="px-5 py-3.5 text-sm text-gray-500 dark:text-slate-400 whitespace-nowrap">{{ $item->published_at ? \Carbon\Carbon::parse($item->published_at)->format('d/m/Y') : $item->created_at->format('d/m/Y') }}</td>
                        <td class="px-5 py-3.5">
                            <form action="{{ route('admin.berita.toggle-status', $item->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold transition-colors {{ $item->status ? 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $item->status ? 'bg-emerald-500' : 'bg-gray-400' }}"></span>
                                    {{ $item->status ? 'Published' : 'Draft' }}
                                </button>
                            </form>
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-1">
                                <x-icon-button :href="route('admin.berita.show', $item->id)" variant="primary" title="Lihat">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </x-icon-button>
                                <x-icon-button :href="route('admin.berita.edit', $item->id)" variant="warning" title="Ubah">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </x-icon-button>
                                <x-icon-button :href="route('admin.berita.destroy', $item->id)" variant="danger" title="Hapus" :delete="true" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-12">
                            <x-empty-state title="Belum ada berita" description="Tambahkan berita atau artikel terbaru">
                                <x-slot name="action">
                                    <x-primary-button href="{{ route('admin.berita.create') }}">+ Tambah Berita</x-primary-button>
                                </x-slot>
                            </x-empty-state>
                        </td>
                    </tr>
                @endforelse
            </x-table>
        </x-card>
    </div>
</x-app-layout>
