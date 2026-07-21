<x-app-layout>
    <x-slot name="header">Tambah Hero Banner</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Hero Banner', 'url' => route('admin.hero.index')],
            ['label' => 'Tambah'],
        ]" />

        <x-admin.module-header title="Tambah Hero Banner" description="Buat banner hero baru untuk halaman utama.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <form action="{{ route('admin.hero.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5" x-data="formValidation()">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <x-input-label for="judul" value="* Judul" />
                        <input type="text" id="judul" name="judul" value="{{ old('judul') }}" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan judul hero banner..." required />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Judul utama yang ditampilkan di banner</p>
                        <x-input-error :messages="$errors->get('judul')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="sub_judul" value="Sub Judul" />
                        <input type="text" id="sub_judul" name="sub_judul" value="{{ old('sub_judul') }}" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan sub judul hero banner..." />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Teks tambahan di bawah judul utama</p>
                        <x-input-error :messages="$errors->get('sub_judul')" class="mt-1" />
                    </div>
                </div>

                <div>
                    <x-input-label for="deskripsi" value="Deskripsi" />
                    <textarea id="deskripsi" name="deskripsi" rows="3" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan deskripsi hero banner...">{{ old('deskripsi') }}</textarea>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Deskripsi singkat tentang hero banner</p>
                    <x-input-error :messages="$errors->get('deskripsi')" class="mt-1" />
                </div>

                <div>
                    <x-input-label for="gambar" value="Gambar" />
                    <x-image-cropper name="gambar" id="gambar" aspectRatio="16/9" />
                    <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, GIF. Maksimal 2MB.</p>
                    <x-input-error :messages="$errors->get('gambar')" class="mt-1" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <x-input-label for="button_text" value="Teks Tombol" />
                        <input type="text" id="button_text" name="button_text" value="{{ old('button_text') }}" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan teks tombol..." />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Contoh: Daftar Sekarang, Pelajari Lebih Lanjut</p>
                        <x-input-error :messages="$errors->get('button_text')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="button_link" value="URL Tombol" />
                        <input type="url" id="button_link" name="button_link" value="{{ old('button_link') }}" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="https://example.com" />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Format: https://example.com</p>
                        <x-input-error :messages="$errors->get('button_link')" class="mt-1" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <x-input-label for="urutan" value="Urutan" />
                        <input type="number" id="urutan" name="urutan" value="{{ old('urutan') }}" min="0" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan urutan tampil..." />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Urutan kemunculan banner (0 = pertama)</p>
                        <x-input-error :messages="$errors->get('urutan')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label value="Status" />
                        <label class="inline-flex items-center gap-2 cursor-pointer mt-2">
                            <input type="checkbox" name="status" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-2 focus:ring-blue-500/20" {{ old('status', true) ? 'checked' : '' }}>
                            <span class="text-sm font-medium text-gray-700">Aktif</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-5 border-t border-gray-200">
                    <x-secondary-button type="button" onclick="window.location='{{ route('admin.hero.index') }}'">Batal</x-secondary-button>
                    <x-primary-button type="submit">Simpan</x-primary-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
