<x-app-layout>
    <x-slot name="header">Edit Galeri</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Galeri', 'url' => route('admin.galeri.index')],
            ['label' => 'Edit'],
        ]" />

        <x-admin.module-header title="Edit Galeri" description="Perbarui informasi gambar galeri.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <form action="{{ route('admin.galeri.update', $data->id) }}" method="POST" enctype="multipart/form-data" x-data="formValidation()">
                @csrf
                @method('PUT')

                <div class="space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <x-input-label for="judul" value="* Judul" />
                            <x-text-input type="text" id="judul" name="judul" :value="old('judul', $data->judul)" class="mt-1" placeholder="Masukkan judul gambar..." required />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Maksimal 255 karakter</p>
                            <x-input-error :messages="$errors->get('judul')" class="mt-1.5" />
                        </div>

                        <div>
                            <x-input-label for="kategori" value="Kategori" />
                            <x-text-input type="text" id="kategori" name="kategori" :value="old('kategori', $data->kategori)" class="mt-1" placeholder="Masukkan kategori gambar..." />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Contoh: Kegiatan, Prestasi, Fasilitas</p>
                            <x-input-error :messages="$errors->get('kategori')" class="mt-1.5" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="gambar" value="Gambar" />
                        @if($data->gambar)
                            <x-image-cropper name="gambar" id="gambar" preview="{{ Storage::url($data->gambar) }}" />
                        @else
                            <x-image-cropper name="gambar" id="gambar" />
                        @endif
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                        <x-input-error :messages="$errors->get('gambar')" class="mt-1.5" />
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100 dark:border-slate-700">
                    <x-secondary-button href="{{ route('admin.galeri.index') }}">Batal</x-secondary-button>
                    <x-primary-button type="submit">Simpan</x-primary-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
