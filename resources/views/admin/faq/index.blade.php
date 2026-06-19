<x-app-layout>
    <x-slot name="header">FAQ</x-slot>

    <div class="space-y-6" x-data="{ open: false, editing: null, form: { pertanyaan: '', jawaban: '', urutan: '', status: 1 } }">
        <x-breadcrumb :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'FAQ']]" />

        <div class="flex justify-between items-center">
            <p class="text-sm text-gray-600">Kelola pertanyaan yang sering diajukan</p>
            <x-primary-button @click="open = true; editing = null; form = { pertanyaan: '', jawaban: '', urutan: '', status: 1 }">
                + Tambah FAQ
            </x-primary-button>
        </div>

        <x-card>
            <x-table :headers="['Pertanyaan', 'Jawaban', 'Urutan', 'Status', 'Aksi']">
                @forelse($data as $item)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="px-4 py-3 font-medium text-gray-900 max-w-xs">{{ $item->pertanyaan }}</td>
                        <td class="px-4 py-3 text-gray-500 max-w-sm truncate">{{ Str::limit($item->jawaban, 80) }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $item->urutan ?? '-' }}</td>
                        <td class="px-4 py-3">
                            @if($item->status)
                                <x-badge color="green">Aktif</x-badge>
                            @else
                                <x-badge color="red">Nonaktif</x-badge>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <x-secondary-button @click="open = true; editing = {{ $item->id }}; form = { pertanyaan: '{{ $item->pertanyaan }}', jawaban: `{{ $item->jawaban }}`, urutan: '{{ $item->urutan }}', status: {{ $item->status ? 1 : 0 }} }">
                                    Edit
                                </x-secondary-button>
                                <form action="{{ route('admin.faq.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus FAQ ini?')">
                                    @csrf @method('DELETE')
                                    <x-danger-button type="submit">Hapus</x-danger-button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8">
                            <x-empty-state title="Belum ada FAQ" description="Tambahkan pertanyaan yang sering diajukan" />
                        </td>
                    </tr>
                @endforelse
            </x-table>
        </x-card>

        <x-modal name="faq-modal" :show="open" maxWidth="2xl">
            <form @submit.prevent="fetch(editing ? '{{ route('admin.faq.update', '') }}/' + editing : '{{ route('admin.faq.store') }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' },
                body: JSON.stringify({ _token: '{{ csrf_token() }}', _method: editing ? 'PUT' : 'POST', pertanyaan: form.pertanyaan, jawaban: form.jawaban, urutan: form.urutan, status: form.status })
            }).then(r => { if(r.ok) window.location.reload() })" class="p-6 space-y-4">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @if(editing) <input type="hidden" name="_method" value="PUT"> @endif

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Pertanyaan</label>
                    <input type="text" name="pertanyaan" x-model="form.pertanyaan" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Jawaban</label>
                    <textarea name="jawaban" x-model="form.jawaban" rows="4" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" required></textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Urutan</label>
                        <input type="number" name="urutan" x-model="form.urutan" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div class="flex items-center gap-2 pt-7">
                        <input type="checkbox" name="status" value="1" x-model="form.status" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
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
