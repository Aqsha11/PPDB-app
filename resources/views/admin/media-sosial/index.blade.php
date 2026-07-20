<x-app-layout>
    <x-slot name="header">Media Sosial</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Media Sosial'],
        ]" />

        <x-admin.module-header title="Media Sosial" description="Kelola tautan media sosial sekolah. Aktifkan atau nonaktifkan, dan perbarui URL masing-masing platform.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <p class="text-sm text-gray-500 dark:text-slate-400 mb-4">Nonaktifkan media sosial jika tidak ingin ditampilkan di halaman publik.</p>

            <x-table :headers="['No', 'Platform', 'URL', 'Status', 'Aksi']">
                @forelse($data as $item)
                    <tr class="border-b border-gray-100 dark:border-slate-700/50 hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                        <td class="px-5 py-3.5 text-sm text-gray-500">{{ $loop->iteration }}</td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                <i class="{!! $item->icon !!} text-xl"></i>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $item->platform }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3.5">
                            <form action="{{ route('admin.media-sosial.update', $item->id) }}" method="POST" class="flex flex-nowrap items-center gap-2">
                                @csrf
                                @method('PUT')
                                <x-text-input type="url" name="url" :value="$item->url" class="min-w-0 flex-1 sm:flex-initial sm:max-w-sm" placeholder="https://example.com" required />
                                <x-primary-button type="submit" class="!px-3 !py-1.5 text-xs shrink-0">Simpan</x-primary-button>
                            </form>
                        </td>
                        <td class="px-5 py-3.5">
                            <form action="{{ route('admin.media-sosial.toggle-status', $item->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold transition-colors {{ $item->status ? 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' : 'bg-gray-100 text-gray-500 hover:bg-gray-200 dark:bg-slate-700 dark:text-slate-400' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $item->status ? 'bg-emerald-500' : 'bg-gray-400' }}"></span>
                                    {{ $item->status ? 'Aktif' : 'Nonaktif' }}
                                </button>
                            </form>
                        </td>
                        <td class="px-5 py-3.5">
                            @if($item->url)
                                <x-icon-button :href="$item->url" variant="info" title="Buka tautan">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                </x-icon-button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-12">
                            <x-empty-state title="Belum ada media sosial" description="Data media sosial akan muncul setelah di-seed." />
                        </td>
                    </tr>
                @endforelse
            </x-table>
        </x-card>
    </div>
</x-app-layout>
