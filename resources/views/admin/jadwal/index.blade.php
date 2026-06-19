<x-app-layout>
    <x-slot name="header">Jadwal PPDB</x-slot>

    <div class="space-y-6" x-data="{ open: false, editing: null, form: { kegiatan: '', tanggal_mulai: '', tanggal_selesai: '', deskripsi: '', urutan: '' } }">
        <x-breadcrumb :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Jadwal PPDB']]" />

        <div class="flex justify-between items-center">
            <p class="text-sm text-gray-600">Kelola jadwal kegiatan PPDB</p>
            <x-primary-button @click="open = true; editing = null; form = { kegiatan: '', tanggal_mulai: '', tanggal_selesai: '', deskripsi: '', urutan: '' }">
                + Tambah Jadwal
            </x-primary-button>
        </div>

        <x-card>
            <x-table :headers="['Urutan', 'Kegiatan', 'Tanggal Mulai', 'Tanggal Selesai', 'Aksi']">
                @forelse($data as $item)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-gray-600">{{ $item->urutan ?? $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $item->kegiatan }}</td>
                        <td class="px-4 py-3 text-gray-500 whitespace-nowrap">{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 text-gray-500 whitespace-nowrap">{{ $item->tanggal_selesai ? \Carbon\Carbon::parse($item->tanggal_selesai)->format('d/m/Y') : '-' }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <x-secondary-button @click="open = true; editing = {{ $item->id }}; form = { kegiatan: '{{ $item->kegiatan }}', tanggal_mulai: '{{ $item->tanggal_mulai }}', tanggal_selesai: '{{ $item->tanggal_selesai }}', deskripsi: '{{ $item->deskripsi }}', urutan: '{{ $item->urutan }}' }">
                                    Edit
                                </x-secondary-button>
                                <form action="{{ route('admin.jadwal.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                                    @csrf @method('DELETE')
                                    <x-danger-button type="submit">Hapus</x-danger-button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8">
                            <x-empty-state title="Belum ada jadwal" description="Tambahkan jadwal kegiatan PPDB" />
                        </td>
                    </tr>
                @endforelse
            </x-table>
        </x-card>

        <x-modal name="jadwal-modal" :show="open" maxWidth="2xl">
            <form @submit.prevent="fetch(editing ? '{{ route('admin.jadwal.update', '') }}/' + editing : '{{ route('admin.jadwal.store') }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' },
                body: JSON.stringify({ _token: '{{ csrf_token() }}', _method: editing ? 'PUT' : 'POST', kegiatan: form.kegiatan, tanggal_mulai: form.tanggal_mulai, tanggal_selesai: form.tanggal_selesai, deskripsi: form.deskripsi, urutan: form.urutan })
            }).then(r => { if(r.ok) window.location.reload() })" class="p-6 space-y-4">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @if(editing) <input type="hidden" name="_method" value="PUT"> @endif

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Kegiatan</label>
                    <input type="text" name="kegiatan" x-model="form.kegiatan" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" x-model="form.tanggal_mulai" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" x-model="form.tanggal_selesai" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi</label>
                    <textarea name="deskripsi" x-model="form.deskripsi" rows="3" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Urutan</label>
                    <input type="number" name="urutan" x-model="form.urutan" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div class="flex justify-end gap-2 pt-4 border-t border-gray-100">
                    <x-secondary-button type="button" @click="open = false">Batal</x-secondary-button>
                    <x-primary-button type="submit">Simpan</x-primary-button>
                </div>
            </form>
        </x-modal>
    </div>
</x-app-layout>
