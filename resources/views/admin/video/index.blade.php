<x-app-layout>
    <x-slot name="header">Video</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Video'],
        ]" />

        <x-admin.module-header title="Video" description="Kelola video YouTube sekolah yang ditampilkan di halaman publik. Tambahkan tautan video beserta judulnya.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </x-slot>
            <x-slot name="actions">
                <x-primary-button href="{{ route('admin.video.create') }}">
                    + Tambah Video
                </x-primary-button>
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <x-table :headers="['No', 'Judul', 'URL Embed', 'Status Aktif', 'Aksi']">
                @forelse($data as $item)
                    <tr class="border-b border-gray-100 dark:border-slate-700/50 hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                        <td class="px-5 py-3.5 text-sm text-gray-500">{{ $loop->iteration }}</td>
                        <td class="px-5 py-3.5 text-sm font-medium text-gray-900 dark:text-white">{{ $item->judul }}</td>
                        <td class="px-5 py-3.5 text-sm text-gray-500 dark:text-slate-400 max-w-[250px] truncate">
                            <a href="{{ $item->youtube_url }}" target="_blank" class="theme-text hover:underline">{{ $item->youtube_url }}</a>
                        </td>
                        <td class="px-5 py-3.5">
                            <form action="{{ route('admin.video.toggle-status', $item->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold transition-colors {{ $item->status ? 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $item->status ? 'bg-emerald-500' : 'bg-gray-400' }}"></span>
                                    {{ $item->status ? 'Aktif' : 'Nonaktif' }}
                                </button>
                            </form>
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-1">
                                <x-icon-button :href="route('admin.video.edit', $item->id)" variant="warning" title="Ubah">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </x-icon-button>
                                <x-icon-button :href="route('admin.video.destroy', $item->id)" variant="danger" title="Hapus" :delete="true" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-12">
                            <x-empty-state title="Belum ada video" description="Tambahkan video YouTube untuk ditampilkan di halaman publik">
                                <x-slot name="action">
                                    <x-primary-button href="{{ route('admin.video.create') }}">+ Tambah Video</x-primary-button>
                                </x-slot>
                            </x-empty-state>
                        </td>
                    </tr>
                @endforelse
            </x-table>
        </x-card>
    </div>
</x-app-layout>
