<x-app-layout>
    <x-slot name="header">Tambah Dokumen</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Persyaratan Dokumen', 'url' => route('admin.dokumen-persyaratan.index')],
            ['label' => 'Tambah'],
        ]" />

        <x-admin.module-header title="Tambah Persyaratan Dokumen" description="Buat persyaratan dokumen baru untuk pendaftaran PPDB.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <form action="{{ route('admin.dokumen-persyaratan.store') }}" method="POST" class="space-y-5">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <x-input-label for="nama_dokumen" value="* Nama Dokumen" />
                        <input type="text" id="nama_dokumen" name="nama_dokumen" value="{{ old('nama_dokumen') }}" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan nama dokumen..." required />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Contoh: Ijazah, Kartu Keluarga, Akta Kelahiran</p>
                        <x-input-error :messages="$errors->get('nama_dokumen')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="kategori" value="Kategori" />
                        <select id="kategori" name="kategori" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                            <option value="">Pilih Kategori...</option>
                            <option value="Identitas" {{ old('kategori') == 'Identitas' ? 'selected' : '' }}>Identitas</option>
                            <option value="Akademik" {{ old('kategori') == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                            <option value="Kesehatan" {{ old('kategori') == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                            <option value="Keuangan" {{ old('kategori') == 'Keuangan' ? 'selected' : '' }}>Keuangan</option>
                            <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Pilih kategori dokumen</p>
                        <x-input-error :messages="$errors->get('kategori')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="jalur_pendaftaran_id" value="* Jalur Pendaftaran" />
                        <select id="jalur_pendaftaran_id" name="jalur_pendaftaran_id" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" required>
                            <option value="">Pilih Jalur...</option>
                            @foreach($jalur as $j)
                                <option value="{{ $j->id }}" {{ old('jalur_pendaftaran_id') == $j->id ? 'selected' : '' }}>{{ $j->nama_jalur }}</option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Pilih jalur pendaftaran terkait</p>
                        <x-input-error :messages="$errors->get('jalur_pendaftaran_id')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label value="Tipe File yang Diizinkan" />
                        <div class="mt-2 flex flex-wrap gap-4">
                            @foreach(['pdf', 'jpg', 'png'] as $type)
                                <label class="inline-flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="format[]" value="{{ $type }}" class="rounded border-gray-300 text-blue-600 focus:ring-2 focus:ring-blue-500/20" {{ in_array($type, old('format', ['pdf', 'jpg', 'png'])) ? 'checked' : '' }}>
                                    <span class="text-sm font-medium text-gray-700 uppercase">{{ $type }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <x-input-label for="keterangan" value="Keterangan" />
                        <textarea id="keterangan" name="keterangan" rows="3" maxlength="255" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan keterangan dokumen...">{{ old('keterangan') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Maksimal 255 karakter</p>
                        <x-input-error :messages="$errors->get('keterangan')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="urutan" value="Urutan" />
                        <input type="number" id="urutan" name="urutan" value="{{ old('urutan', 0) }}" min="0" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan urutan tampilan..." />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Angka menentukan posisi tampilan (0 = paling atas)</p>
                        <x-input-error :messages="$errors->get('urutan')" class="mt-1" />
                    </div>

                    <div class="flex items-end">
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_wajib" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-2 focus:ring-blue-500/20" {{ old('is_wajib', true) ? 'checked' : '' }}>
                            <span class="text-sm font-medium text-gray-700">Dokumen wajib</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-5 border-t border-gray-200">
                    <x-secondary-button type="button" onclick="window.location='{{ route('admin.dokumen-persyaratan.index') }}'">Batal</x-secondary-button>
                    <x-primary-button type="submit">Simpan</x-primary-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
