<x-app-layout>
    <x-slot name="header">Tambah Testimoni</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Testimoni', 'url' => route('admin.testimoni.index')],
            ['label' => 'Tambah'],
        ]" />

        <x-admin.module-header title="Tambah Testimoni" description="Tambahkan testimoni baru dari peserta atau orang tua.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <form action="{{ route('admin.testimoni.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <x-input-label for="nama" value="* Nama" />
                            <x-text-input type="text" id="nama" name="nama" :value="old('nama')" class="mt-1" placeholder="Masukkan nama pemberi testimoni..." required />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Nama lengkap pemberi testimoni</p>
                            <x-input-error :messages="$errors->get('nama')" class="mt-1.5" />
                        </div>

                        <div>
                            <x-input-label for="rating" value="* Rating" />
                            <select id="rating" name="rating" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm transition-colors" required>
                                <option value="">Pilih rating...</option>
                                @for($i = 5; $i >= 1; $i--)
                                    <option value="{{ $i }}" {{ old('rating', 5) == $i ? 'selected' : '' }}>{{ $i }} Bintang</option>
                                @endfor
                            </select>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Beri penilaian dari 1 sampai 5 bintang</p>
                            <x-input-error :messages="$errors->get('rating')" class="mt-1.5" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="isi" value="* Isi Testimoni" />
                        <textarea id="isi" name="isi" rows="4" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm transition-colors" placeholder="Masukkan isi testimoni..." required>{{ old('isi') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Ceritakan pengalaman menggunakan layanan sekolah</p>
                        <x-input-error :messages="$errors->get('isi')" class="mt-1.5" />
                    </div>

                    <div>
                        <x-input-label for="foto" value="Foto (opsional)" />
                        <x-image-cropper name="foto" id="foto" aspectRatio="1" />
                        <x-input-error :messages="$errors->get('foto')" class="mt-1.5" />
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100 dark:border-slate-700">
                    <x-secondary-button href="{{ route('admin.testimoni.index') }}">Batal</x-secondary-button>
                    <x-primary-button type="submit">Simpan</x-primary-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
