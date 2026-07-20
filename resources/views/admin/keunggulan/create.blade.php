<x-app-layout>
    <x-slot name="header">Tambah Keunggulan</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Keunggulan', 'url' => route('admin.keunggulan.index')],
            ['label' => 'Tambah'],
        ]" />

        <x-admin.module-header title="Tambah Keunggulan" description="Tambahkan keunggulan baru sekolah untuk ditampilkan di halaman publik.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <form action="{{ route('admin.keunggulan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <x-input-label for="judul" value="* Judul" />
                        <input type="text" id="judul" name="judul" value="{{ old('judul') }}" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan judul keunggulan..." required />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Judul singkat keunggulan sekolah</p>
                        <x-input-error :messages="$errors->get('judul')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="icon" value="Icon (CSS class)" />
                        <input type="text" id="icon" name="icon" value="{{ old('icon') }}" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan class icon CSS..." />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Contoh: fas fa-star, bi bi-book</p>
                        <x-input-error :messages="$errors->get('icon')" class="mt-1" />
                    </div>
                </div>

                <div>
                    <x-input-label for="deskripsi" value="* Deskripsi" />
                    <textarea id="deskripsi" name="deskripsi" rows="4" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan deskripsi keunggulan..." required>{{ old('deskripsi') }}</textarea>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Penjelasan detail tentang keunggulan ini</p>
                    <x-input-error :messages="$errors->get('deskripsi')" class="mt-1" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <x-input-label for="urutan" value="Urutan" />
                        <input type="number" id="urutan" name="urutan" value="{{ old('urutan') }}" min="0" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan urutan tampil..." />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Urutan kemunculan (0 = pertama)</p>
                        <x-input-error :messages="$errors->get('urutan')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="gambar" value="Gambar" />
                        <x-image-cropper name="gambar" id="gambar" />
                        <x-input-error :messages="$errors->get('gambar')" class="mt-1" />
                    </div>
                </div>

                <div>
                    <label class="inline-flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_aktif" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-2 focus:ring-blue-500/20" {{ old('is_aktif', true) ? 'checked' : '' }}>
                        <span class="text-sm font-medium text-gray-700">Aktifkan</span>
                    </label>
                </div>

                <div class="flex items-center justify-end gap-3 pt-5 border-t border-gray-200">
                    <x-secondary-button type="button" onclick="window.location='{{ route('admin.keunggulan.index') }}'">Batal</x-secondary-button>
                    <x-primary-button type="submit">Simpan</x-primary-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
