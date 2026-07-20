<x-app-layout>
    <x-slot name="header">Tambah Berita</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Berita', 'url' => route('admin.berita.index')],
            ['label' => 'Tambah'],
        ]" />

        <x-admin.module-header title="Tambah Berita" description="Buat berita atau artikel baru untuk dipublikasikan.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="space-y-5">
                    <div>
                        <x-input-label for="judul" value="* Judul" />
                        <x-text-input type="text" id="judul" name="judul" :value="old('judul')" class="mt-1" placeholder="Masukkan judul berita..." required />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Maksimal 255 karakter</p>
                        <x-input-error :messages="$errors->get('judul')" class="mt-1.5" />
                    </div>

                    <div>
                        <x-input-label for="penulis" value="Penulis" />
                        <x-text-input type="text" id="penulis" name="penulis" :value="old('penulis')" class="mt-1" placeholder="Masukkan nama penulis..." />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Nama penulis berita (opsional)</p>
                        <x-input-error :messages="$errors->get('penulis')" class="mt-1.5" />
                    </div>

                    <div>
                        <x-input-label for="konten" value="* Konten" />
                        <textarea id="konten" name="konten" rows="10" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm transition-colors" placeholder="Masukkan isi berita..." required>{{ old('konten') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Tulis isi berita secara lengkap</p>
                        <x-input-error :messages="$errors->get('konten')" class="mt-1.5" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <x-input-label for="thumbnail" value="Thumbnail" />
                            <x-image-cropper name="thumbnail" id="thumbnail" />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Format: JPG, PNG, GIF. Maks 2MB.</p>
                            <x-input-error :messages="$errors->get('thumbnail')" class="mt-1.5" />
                        </div>

                        <div>
                            <x-input-label for="published_at" value="Tanggal Terbit" />
                            <x-text-input type="date" id="published_at" name="published_at" :value="old('published_at')" class="mt-1" />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Tanggal penerbitan berita (opsional)</p>
                            <x-input-error :messages="$errors->get('published_at')" class="mt-1.5" />
                        </div>
                    </div>

                    <div>
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="status" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" {{ old('status', true) ? 'checked' : '' }}>
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
