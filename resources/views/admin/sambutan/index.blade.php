<x-app-layout>
    <x-slot name="header">Sambutan Kepala Sekolah</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Sambutan'],
        ]" />

        <x-admin.module-header title="Sambutan Kepala Sekolah" description="Kelola sambutan dan foto kepala sekolah yang ditampilkan di halaman publik.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <form action="{{ route('admin.sambutan.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <x-input-label for="nama_kepala_sekolah" value="* Nama Kepala Sekolah" />
                        <input type="text" id="nama_kepala_sekolah" name="nama_kepala_sekolah" value="{{ old('nama_kepala_sekolah', $data->nama_kepala_sekolah ?? $data->nama ?? '') }}" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan nama kepala sekolah..." required />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Nama lengkap kepala sekolah</p>
                        <x-input-error :messages="$errors->get('nama_kepala_sekolah')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="foto" value="Foto" />
                        @if($data->foto ?? null)
                            <x-image-cropper name="foto" id="foto" preview="{{ Storage::url($data->foto) }}" aspectRatio="3/4" />
                        @else
                            <x-image-cropper name="foto" id="foto" aspectRatio="3/4" />
                        @endif
                        <x-input-error :messages="$errors->get('foto')" class="mt-1" />
                    </div>
                </div>

                <div>
                    <x-input-label for="sambutan" value="* Sambutan" />
                    <textarea id="sambutan" name="sambutan" rows="10" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan teks sambutan kepala sekolah..." required>{{ old('sambutan', $data->sambutan ?? $data->isi ?? '') }}</textarea>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Sambutan yang ditampilkan di halaman publik</p>
                    <x-input-error :messages="$errors->get('sambutan')" class="mt-1" />
                </div>

                <div class="flex items-center justify-end pt-5 border-t border-gray-200">
                    <x-primary-button type="submit">Simpan</x-primary-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
