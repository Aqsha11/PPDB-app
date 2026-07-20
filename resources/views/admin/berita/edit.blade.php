<x-app-layout>
    <x-slot name="header">Edit Berita</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Berita', 'url' => route('admin.berita.index')],
            ['label' => 'Edit'],
        ]" />

        <x-admin.module-header title="Edit Berita" description="Perbarui informasi berita atau artikel.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <form action="{{ route('admin.berita.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-5">
                    <div>
                        <x-input-label for="judul" value="* Judul" />
                        <x-text-input type="text" id="judul" name="judul" :value="old('judul', $data->judul)" class="mt-1" placeholder="Masukkan judul berita..." required />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Maksimal 255 karakter</p>
                        <x-input-error :messages="$errors->get('judul')" class="mt-1.5" />
                    </div>

                    <div>
                        <x-input-label for="penulis" value="Penulis" />
                        <x-text-input type="text" id="penulis" name="penulis" :value="old('penulis', $data->penulis)" class="mt-1" placeholder="Masukkan nama penulis..." />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Nama penulis berita (opsional)</p>
                        <x-input-error :messages="$errors->get('penulis')" class="mt-1.5" />
                    </div>

                    <div>
                        <x-input-label for="konten" value="* Konten" />
                        <textarea id="konten" name="konten" rows="10" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm transition-colors" placeholder="Masukkan isi berita..." required>{{ old('konten', $data->konten) }}</textarea>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Tulis isi berita secara lengkap</p>
                        <x-input-error :messages="$errors->get('konten')" class="mt-1.5" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <x-input-label for="thumbnail" value="Thumbnail" />
                            @if($data->thumbnail)
                                <x-image-cropper name="thumbnail" id="thumbnail" preview="{{ Storage::url($data->thumbnail) }}" />
                            @else
                                <x-image-cropper name="thumbnail" id="thumbnail" />
                            @endif
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Biarkan kosong jika tidak ingin mengubah thumbnail.</p>
                            <x-input-error :messages="$errors->get('thumbnail')" class="mt-1.5" />
                        </div>

                        <div>
                            <x-input-label for="published_at" value="Tanggal Terbit" />
                            <x-text-input type="date" id="published_at" name="published_at" :value="old('published_at', $data->published_at ? $data->published_at->format('Y-m-d') : '')" class="mt-1" />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Tanggal penerbitan berita (opsional)</p>
                            <x-input-error :messages="$errors->get('published_at')" class="mt-1.5" />
                        </div>
                    </div>

                    <div>
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="status" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" {{ old('status', $data->status) ? 'checked' : '' }}>
                            <span class="text-sm font-medium text-gray-700 dark:text-slate-300">Publikasikan</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100 dark:border-slate-700">
                    <x-secondary-button href="{{ route('admin.berita.index') }}">Batal</x-secondary-button>
                    <x-primary-button type="submit">Simpan</x-primary-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
