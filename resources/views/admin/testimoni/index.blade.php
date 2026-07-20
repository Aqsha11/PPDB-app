<x-app-layout>
    <x-slot name="header">Testimoni</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Testimoni'],
        ]" />

        <x-admin.module-header title="Testimoni" description="Kelola testimoni dari peserta, orang tua, atau alumni. Tambahkan ulasan beserta foto dan rating.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
            </x-slot>
            <x-slot name="actions">
                <x-primary-button href="{{ route('admin.testimoni.create') }}">
                    + Tambah Testimoni
                </x-primary-button>
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <x-table :headers="['No', 'Nama', 'Testimoni', 'Rating', 'Status Aktif', 'Aksi']">
                @forelse($data as $item)
                    <tr class="border-b border-gray-100 dark:border-slate-700/50 hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                        <td class="px-5 py-3.5 text-sm text-gray-500">{{ $loop->iteration }}</td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                @if($item->foto)
                                    <img src="{{ Storage::url($item->foto) }}" class="w-9 h-9 rounded-full object-cover border border-gray-200 dark:border-slate-600">
                                @else
                                    <div class="w-9 h-9 rounded-full bg-blue-50 dark:bg-blue-500/15 flex items-center justify-center text-blue-600 font-semibold text-sm">
                                        {{ strtoupper(substr($item->nama, 0, 1)) }}
                                    </div>
                                @endif
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $item->nama }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3.5 text-sm text-gray-500 dark:text-slate-400 max-w-xs truncate">{{ Str::limit($item->isi, 60) }}</td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-0.5">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= ($item->rating ?? 0))
                                        <svg class="w-4 h-4 text-amber-400 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                    @else
                                        <svg class="w-4 h-4 text-gray-300 dark:text-slate-600 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                    @endif
                                @endfor
                            </div>
                        </td>
                        <td class="px-5 py-3.5">
                            <form action="{{ route('admin.testimoni.toggle-status', $item->id) }}" method="POST" class="inline">
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
                                <x-icon-button :href="route('admin.testimoni.edit', $item->id)" variant="warning" title="Ubah">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </x-icon-button>
                                <x-icon-button :href="route('admin.testimoni.destroy', $item->id)" variant="danger" title="Hapus" :delete="true" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-12">
                            <x-empty-state title="Belum ada testimoni" description="Tambahkan testimoni dari peserta atau orang tua">
                                <x-slot name="action">
                                    <x-primary-button href="{{ route('admin.testimoni.create') }}">+ Tambah Testimoni</x-primary-button>
                                </x-slot>
                            </x-empty-state>
                        </td>
                    </tr>
                @endforelse
            </x-table>
        </x-card>
    </div>
</x-app-layout>
