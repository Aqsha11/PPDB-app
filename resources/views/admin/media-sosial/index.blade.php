<x-app-layout>
    <x-slot name="header">Media Sosial</x-slot>

    <div class="space-y-6" x-data="{ open: false, editing: null, form: { platform: '', ikon: '', url: '', urutan: '', is_aktif: 1 } }">
        <x-breadcrumb :items="[['label' => 'Dashboard', 'route' => 'admin.dashboard'], ['label' => 'Media Sosial']]" />

        <div class="flex justify-between items-center">
            <p class="text-sm text-gray-600">Kelola tautan media sosial</p>
            <x-primary-button @click="open = true; editing = null; form = { platform: '', ikon: '', url: '', urutan: '', is_aktif: 1 }">
                + Tambah Media Sosial
            </x-primary-button>
        </div>

        <x-card>
            <x-table :headers="['Platform', 'Ikon', 'URL', 'Urutan', 'Status', 'Aksi']">
                @forelse($data as $item)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $item->platform }}</td>
                        <td class="px-4 py-3 text-2xl">{{ $item->ikon ?? $item->icon ?? '-' }}</td>
                        <td class="px-4 py-3 max-w-xs truncate">
                            <a href="{{ $item->url }}" target="_blank" class="text-blue-600 hover:underline">{{ $item->url }}</a>
                        </td>
                        <td class="px-4 py-3 text-gray-600">{{ $item->urutan ?? '-' }}</td>
                        <td class="px-4 py-3">
                            @if($item->is_aktif ?? $item->status)
                                <x-badge color="green">Aktif</x-badge>
                            @else
                                <x-badge color="red">Nonaktif</x-badge>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <x-secondary-button @click="open = true; editing = {{ $item->id }}; form = { platform: '{{ $item->platform }}', ikon: '{{ $item->ikon ?? $item->icon ?? '' }}', url: '{{ $item->url }}', urutan: '{{ $item->urutan }}', is_aktif: {{ ($item->is_aktif ?? $item->status) ? 1 : 0 }} }">
                                    Edit
                                </x-secondary-button>
                                <form action="{{ route('admin.media-sosial.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus media sosial ini?')">
                                    @csrf @method('DELETE')
                                    <x-danger-button type="submit">Hapus</x-danger-button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8">
                            <x-empty-state title="Belum ada media sosial" description="Tambahkan tautan media sosial baru" />
                        </td>
                    </tr>
                @endforelse
            </x-table>
        </x-card>

        <x-modal name="media-sosial-modal" :show="open" maxWidth="lg">
            <form @submit.prevent="fetch(editing ? '{{ route('admin.media-sosial.update', '') }}/' + editing : '{{ route('admin.media-sosial.store') }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' },
                body: JSON.stringify({ _token: '{{ csrf_token() }}', _method: editing ? 'PUT' : 'POST', platform: form.platform, ikon: form.ikon, url: form.url, urutan: form.urutan, is_aktif: form.is_aktif })
            }).then(r => { if(r.ok) window.location.reload() })" class="p-6 space-y-4">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @if(editing) <input type="hidden" name="_method" value="PUT"> @endif

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Platform</label>
                    <input type="text" name="platform" x-model="form.platform" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" required placeholder="Facebook, Instagram, Twitter, dll">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Ikon</label>
                    <input type="text" name="ikon" x-model="form.ikon" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="contoh: 📷 atau fab fa-instagram">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">URL</label>
                    <input type="url" name="url" x-model="form.url" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" required placeholder="https://">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Urutan</label>
                        <input type="number" name="urutan" x-model="form.urutan" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div class="flex items-center gap-2 pt-7">
                        <input type="checkbox" name="is_aktif" value="1" x-model="form.is_aktif" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <label class="text-sm font-medium text-gray-700">Aktif</label>
                    </div>
                </div>
                <div class="flex justify-end gap-2 pt-4 border-t border-gray-100">
                    <x-secondary-button type="button" @click="open = false">Batal</x-secondary-button>
                    <x-primary-button type="submit">Simpan</x-primary-button>
                </div>
            </form>
        </x-modal>
    </div>
</x-app-layout>
