<x-app-layout>
    <x-slot name="header">Edit Keunggulan Sekolah</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Keunggulan', 'url' => route('admin.keunggulan.index')],
            ['label' => 'Edit'],
        ]" />

        <x-admin.module-header title="Edit Keunggulan Sekolah" description="Perbarui informasi keunggulan sekolah.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <form action="{{ route('admin.keunggulan.update', $data->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <x-input-label for="judul" value="* Judul" />
                        <input type="text" id="judul" name="judul" value="{{ old('judul', $data->judul) }}" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan judul keunggulan..." required />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Judul singkat keunggulan sekolah</p>
                        <x-input-error :messages="$errors->get('judul')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="icon" value="Icon (CSS class)" />
                        <input type="text" id="icon" name="icon" value="{{ old('icon', $data->icon) }}" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan class icon CSS..." />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Contoh: fas fa-star, bi bi-book</p>
                        <x-input-error :messages="$errors->get('icon')" class="mt-1" />
                    </div>
                </div>

                <div>
                    <x-input-label for="deskripsi" value="* Deskripsi" />
                    <textarea id="deskripsi" name="deskripsi" rows="4" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan deskripsi keunggulan..." required>{{ old('deskripsi', $data->deskripsi) }}</textarea>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Penjelasan detail tentang keunggulan ini</p>
                    <x-input-error :messages="$errors->get('deskripsi')" class="mt-1" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <x-input-label for="urutan" value="Urutan" />
                        <input type="number" id="urutan" name="urutan" value="{{ old('urutan', $data->urutan ?? '') }}" min="0" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan urutan tampil..." />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Urutan kemunculan (0 = pertama)</p>
                        <x-input-error :messages="$errors->get('urutan')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="gambar" value="Gambar" />
                        @if($data->gambar)
                            <x-image-cropper name="gambar" id="gambar" preview="{{ Storage::url($data->gambar) }}" />
                        @else
                            <x-image-cropper name="gambar" id="gambar" />
                        @endif
                        <p class="mt-1 text-xs text-gray-500">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                        <x-input-error :messages="$errors->get('gambar')" class="mt-1" />
                    </div>
                </div>

                <div>
                    <label class="inline-flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_aktif" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-2 focus:ring-blue-500/20" @checked(old('is_aktif', $data->is_aktif ?? true))>
                        <span class="text-sm font-medium text-gray-700">Aktifkan</span>
                    </label>
                </div>

                <div class="flex items-center justify-end gap-3 pt-5 border-t border-gray-200">
                    <x-secondary-button type="button" onclick="window.location='{{ route('admin.keunggulan.index') }}'">Batal</x-secondary-button>
                    <x-primary-button type="submit">Update</x-primary-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
