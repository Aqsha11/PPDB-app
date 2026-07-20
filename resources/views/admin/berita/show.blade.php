<x-app-layout>
    <x-slot name="header">Detail Berita</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Berita', 'url' => route('admin.berita.index')],
            ['label' => 'Detail'],
        ]" />

        <x-card>
            <div class="space-y-6">
                @if($data->thumbnail)
                    <div>
                        <img src="{{ Storage::url($data->thumbnail) }}" class="w-full max-w-lg h-64 object-cover rounded-lg border border-gray-200">
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Judul</label>
                        <p class="text-sm text-gray-900 bg-gray-50 rounded-lg px-4 py-2.5 border border-gray-200">{{ $data->judul }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Slug</label>
                        <p class="text-sm text-gray-900 bg-gray-50 rounded-lg px-4 py-2.5 border border-gray-200">{{ $data->slug }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Status</label>
                        <div class="mt-1.5">
                            @if($data->status)
                                <x-badge color="green">Published</x-badge>
                            @else
                                <x-badge color="yellow">Draft</x-badge>
                            @endif
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Tanggal Terbit</label>
                        <p class="text-sm text-gray-900 bg-gray-50 rounded-lg px-4 py-2.5 border border-gray-200">{{ $data->published_at ? \Carbon\Carbon::parse($data->published_at)->format('d/m/Y') : '-' }}</p>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Konten</label>
                    <div class="text-sm text-gray-900 bg-gray-50 rounded-lg px-4 py-2.5 border border-gray-200 whitespace-pre-wrap">{{ $data->konten }}</div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.berita.edit', $data->id) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">Edit Berita</a>
                    <a href="{{ route('admin.berita.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">Kembali</a>
                </div>
            </div>
        </x-card>
    </div>
</x-app-layout>
