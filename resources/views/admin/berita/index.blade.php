<x-app-layout>
    <x-slot name="header">Berita</x-slot>

    <div class="space-y-6" x-data="{ open: false, editing: null, form: { judul: '', konten: '', status: 1, published_at: '' } }">
        <x-breadcrumb :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Berita']]" />

        <div class="flex justify-between items-center">
            <p class="text-sm text-gray-600">Kelola berita dan artikel</p>
            <x-primary-button @click="open = true; editing = null; form = { judul: '', konten: '', status: 1, published_at: '' }">
                + Tambah Berita
            </x-primary-button>
        </div>

        <x-card>
            <x-table :headers="['Thumbnail', 'Judul', 'Penulis', 'Tanggal', 'Status', 'Aksi']">
                @forelse($data as $item)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="px-4 py-3 whitespace-nowrap">
                            @if($item->thumbnail)
                                <img src="{{ Storage::url($item->thumbnail) }}" class="w-16 h-12 object-cover rounded-lg">
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-900 max-w-xs truncate">{{ $item->judul }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $item->penulis ?? '-' }}</td>
                        <td class="px-4 py-3 text-gray-500 whitespace-nowrap">{{ $item->published_at ? \Carbon\Carbon::parse($item->published_at)->format('d/m/Y') : ($item->created_at->format('d/m/Y')) }}</td>
                        <td class="px-4 py-3">
                            @if($item->status)
                                <x-badge color="green">Published</x-badge>
                            @else
                                <x-badge color="yellow">Draft</x-badge>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <x-secondary-button @click="open = true; editing = {{ $item->id }}; form = { judul: '{{ $item->judul }}', konten: `{{ $item->konten }}`, status: {{ $item->status ? 1 : 0 }}, published_at: '{{ $item->published_at ? \Carbon\Carbon::parse($item->published_at)->format('Y-m-d') : '' }}' }">
                                    Edit
                                </x-secondary-button>
                                <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                    @csrf @method('DELETE')
                                    <x-danger-button type="submit">Hapus</x-danger-button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8">
                            <x-empty-state title="Belum ada berita" description="Tambahkan berita atau artikel terbaru" />
                        </td>
                    </tr>
                @endforelse
            </x-table>
        </x-card>

        <x-modal name="berita-modal" :show="open" maxWidth="2xl">
            <form @submit.prevent="fetch(editing ? '{{ route('admin.berita.update', '') }}/' + editing : '{{ route('admin.berita.store') }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: new FormData($el)
            }).then(r => { if(r.ok) window.location.reload() })" class="p-6 space-y-4" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @if(editing) <input type="hidden" name="_method" value="PUT"> @endif

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Judul</label>
                    <input type="text" name="judul" x-model="form.judul" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Konten</label>
                    <textarea name="konten" x-model="form.konten" rows="8" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" required></textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Thumbnail</label>
                        <input type="file" name="thumbnail" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Tanggal Terbit</label>
                        <input type="date" name="published_at" x-model="form.published_at" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="status" value="1" x-model="form.status" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <label class="text-sm font-medium text-gray-700">Publikasikan</label>
                </div>
                <div class="flex justify-end gap-2 pt-4 border-t border-gray-100">
                    <x-secondary-button type="button" @click="open = false">Batal</x-secondary-button>
                    <x-primary-button type="submit">Simpan</x-primary-button>
                </div>
            </form>
        </x-modal>
    </div>
</x-app-layout>
