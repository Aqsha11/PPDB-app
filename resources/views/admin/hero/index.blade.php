<x-app-layout>
    <x-slot name="header">Hero Banner</x-slot>

    <div class="space-y-6" x-data="{ open: false, editing: null, form: { judul: '', sub_judul: '', deskripsi: '', button_text: '', button_link: '', urutan: '', status: 1 } }">
        <x-breadcrumb :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Hero Banner']]" />

        <div class="flex justify-between items-center">
            <p class="text-sm text-gray-600">Kelola banner hero halaman utama</p>
            <x-primary-button @click="open = true; editing = null; form = { judul: '', sub_judul: '', deskripsi: '', button_text: '', button_link: '', urutan: '', status: 1 }">
                + Tambah Hero
            </x-primary-button>
        </div>

        <x-card>
            <x-table :headers="['Gambar', 'Judul', 'Sub Judul', 'Status', 'Aksi']">
                @forelse($data as $item)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="px-4 py-3 whitespace-nowrap">
                            @if($item->gambar)
                                <img src="{{ Storage::url($item->gambar) }}" class="w-20 h-14 object-cover rounded-lg">
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $item->judul }}</td>
                        <td class="px-4 py-3 text-gray-500 max-w-xs truncate">{{ $item->sub_judul ?? '-' }}</td>
                        <td class="px-4 py-3">
                            @if($item->status)
                                <x-badge color="green">Aktif</x-badge>
                            @else
                                <x-badge color="red">Nonaktif</x-badge>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <x-secondary-button @click="open = true; editing = {{ $item->id }}; form = { judul: '{{ $item->judul }}', sub_judul: '{{ $item->sub_judul }}', deskripsi: '{{ $item->deskripsi }}', button_text: '{{ $item->button_text }}', button_link: '{{ $item->button_link }}', urutan: '{{ $item->urutan }}', status: {{ $item->status ? 1 : 0 }} }">
                                    Edit
                                </x-secondary-button>
                                <form action="{{ route('admin.hero.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus banner ini?')">
                                    @csrf @method('DELETE')
                                    <x-danger-button type="submit">Hapus</x-danger-button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8">
                            <x-empty-state title="Belum ada hero banner" description="Tambahkan banner hero baru untuk halaman utama" />
                        </td>
                    </tr>
                @endforelse
            </x-table>
        </x-card>

        <x-modal name="hero-modal" :show="open" maxWidth="2xl">
            <form @submit.prevent="fetch(editing ? '{{ route('admin.hero.update', '') }}/' + editing : '{{ route('admin.hero.store') }}', {
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
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Sub Judul</label>
                        <input type="text" name="sub_judul" x-model="form.sub_judul" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Urutan</label>
                        <input type="number" name="urutan" x-model="form.urutan" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi</label>
                    <textarea name="deskripsi" x-model="form.deskripsi" rows="3" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Teks Tombol</label>
                        <input type="text" name="button_text" x-model="form.button_text" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">URL Tombol</label>
                        <input type="url" name="button_link" x-model="form.button_link" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Gambar</label>
                    <input type="file" name="gambar" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="status" value="1" x-model="form.status" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <label class="text-sm font-medium text-gray-700">Aktif</label>
                </div>
                <div class="flex justify-end gap-2 pt-4 border-t border-gray-100">
                    <x-secondary-button type="button" @click="open = false">Batal</x-secondary-button>
                    <x-primary-button type="submit">Simpan</x-primary-button>
                </div>
            </form>
        </x-modal>
    </div>
</x-app-layout>
