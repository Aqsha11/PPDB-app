<x-app-layout>
    <x-slot name="header">Video</x-slot>

    <div class="space-y-6" x-data="{ open: false, form: { judul: '', youtube_url: '' } }">
        <x-breadcrumb :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Video']]" />

        <div class="flex justify-between items-center">
            <p class="text-sm text-gray-600">Kelola video YouTube</p>
            <x-primary-button @click="open = true; form = { judul: '', youtube_url: '' }">
                + Tambah Video
            </x-primary-button>
        </div>

        <x-card>
            <x-table :headers="['Judul', 'URL', 'Aksi']">
                @forelse($data as $item)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $item->judul }}</td>
                        <td class="px-4 py-3 text-gray-500 max-w-[250px] truncate">
                            <a href="{{ $item->youtube_url }}" target="_blank" class="text-blue-600 hover:underline">{{ $item->youtube_url }}</a>
                        </td>
                        <td class="px-4 py-3">
                            <form action="{{ route('admin.video.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus video ini?')">
                                @csrf @method('DELETE')
                                <x-danger-button type="submit">Hapus</x-danger-button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-4 py-8">
                            <x-empty-state title="Belum ada video" description="Tambahkan video YouTube" />
                        </td>
                    </tr>
                @endforelse
            </x-table>
        </x-card>

        <x-modal name="video-modal" :show="open" maxWidth="lg">
            <form action="{{ route('admin.video.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Judul Video</label>
                    <input type="text" name="judul" x-model="form.judul" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">URL YouTube</label>
                    <input type="url" name="youtube_url" x-model="form.youtube_url" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" required placeholder="https://www.youtube.com/watch?v=...">
                </div>
                <div class="flex justify-end gap-2 pt-4 border-t border-gray-100">
                    <x-secondary-button type="button" @click="open = false">Batal</x-secondary-button>
                    <x-primary-button type="submit">Simpan</x-primary-button>
                </div>
            </form>
        </x-modal>
    </div>
</x-app-layout>
