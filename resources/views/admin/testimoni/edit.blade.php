<x-app-layout>
    <x-slot name="header">Edit Testimoni</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Testimoni', 'url' => route('admin.testimoni.index')],
            ['label' => 'Edit'],
        ]" />

        <x-admin.module-header title="Edit Testimoni" description="Perbarui informasi testimoni.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <form action="{{ route('admin.testimoni.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <x-input-label for="nama" value="* Nama" />
                            <x-text-input type="text" id="nama" name="nama" :value="old('nama', $data->nama)" class="mt-1" placeholder="Masukkan nama pemberi testimoni..." required />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Nama lengkap pemberi testimoni</p>
                            <x-input-error :messages="$errors->get('nama')" class="mt-1.5" />
                        </div>

                        <div>
                            <x-input-label for="rating" value="* Rating" />
                            <select id="rating" name="rating" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm transition-colors" required>
                                <option value="">Pilih rating...</option>
                                @for($i = 5; $i >= 1; $i--)
                                    <option value="{{ $i }}" {{ old('rating', $data->rating) == $i ? 'selected' : '' }}>{{ $i }} Bintang</option>
                                @endfor
                            </select>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Beri penilaian dari 1 sampai 5 bintang</p>
                            <x-input-error :messages="$errors->get('rating')" class="mt-1.5" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="isi" value="* Isi Testimoni" />
                        <textarea id="isi" name="isi" rows="4" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm transition-colors" placeholder="Masukkan isi testimoni..." required>{{ old('isi', $data->isi) }}</textarea>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Ceritakan pengalaman menggunakan layanan sekolah</p>
                        <x-input-error :messages="$errors->get('isi')" class="mt-1.5" />
                    </div>

                    <div>
                        <x-input-label for="foto" value="Foto (opsional)" />
                        @if($data->foto)
                            <x-image-cropper name="foto" id="foto" preview="{{ Storage::url($data->foto) }}" aspectRatio="1" />
                        @else
                            <x-image-cropper name="foto" id="foto" aspectRatio="1" />
                        @endif
                        <p class="mt-1 text-xs text-gray-500 dark:text-slate-400">Biarkan kosong jika tidak ingin mengubah foto.</p>
                        <x-input-error :messages="$errors->get('foto')" class="mt-1.5" />
                    </div>

                    <div>
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="status" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" {{ old('status', $data->status ?? true) ? 'checked' : '' }}>
                            <span class="text-sm font-medium text-gray-700 dark:text-slate-300">Status Aktif</span>
                        </label>
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
