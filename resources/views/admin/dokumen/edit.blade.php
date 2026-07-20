<x-app-layout>
    <x-slot name="header">Edit Persyaratan Dokumen</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Persyaratan Dokumen', 'url' => route('admin.dokumen-persyaratan.index')],
            ['label' => 'Edit'],
        ]" />

        <x-admin.module-header title="Edit Persyaratan Dokumen" description="Perbarui informasi persyaratan dokumen.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </x-slot>
        </x-admin.module-header>

        <x-card>
            @php
                $existingFormat = explode(',', $data->format ?? 'pdf,jpg,png');
            @endphp
            <form action="{{ route('admin.dokumen-persyaratan.update', $data->id) }}" method="POST" class="space-y-5">
                @csrf @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <x-input-label for="nama_dokumen" value="* Nama Dokumen" />
                        <input type="text" id="nama_dokumen" name="nama_dokumen" value="{{ old('nama_dokumen', $data->nama) }}" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan nama dokumen..." required />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Contoh: Ijazah, Kartu Keluarga, Akta Kelahiran</p>
                        <x-input-error :messages="$errors->get('nama_dokumen')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="kategori" value="Kategori" />
                        <select id="kategori" name="kategori" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                            <option value="">Pilih Kategori...</option>
                            @foreach(['Identitas', 'Akademik', 'Kesehatan', 'Keuangan', 'Lainnya'] as $kat)
                                <option value="{{ $kat }}" {{ old('kategori', $data->kategori) == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Pilih kategori dokumen</p>
                        <x-input-error :messages="$errors->get('kategori')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="jalur_pendaftaran_id" value="Jalur Pendaftaran" />
                        <input type="hidden" name="jalur_pendaftaran_id" value="{{ $data->jalur_pendaftaran_id }}">
                        <input type="text" value="{{ $data->jalurPendaftaran->nama_jalur ?? '-' }}" class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-100 px-4 py-2.5 text-sm text-gray-500" disabled />
                    </div>

                    <div>
                        <x-input-label value="Tipe File yang Diizinkan" />
                        <div class="mt-2 flex flex-wrap gap-4">
                            @foreach(['pdf', 'jpg', 'png'] as $type)
                                <label class="inline-flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="format[]" value="{{ $type }}" class="rounded border-gray-300 text-blue-600 focus:ring-2 focus:ring-blue-500/20" {{ in_array($type, old('format', $existingFormat)) ? 'checked' : '' }}>
                                    <span class="text-sm font-medium text-gray-700 uppercase">{{ $type }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <x-input-label for="keterangan" value="Keterangan" />
                        <textarea id="keterangan" name="keterangan" rows="3" maxlength="255" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan keterangan dokumen...">{{ old('keterangan', $data->keterangan ?? '') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Maksimal 255 karakter</p>
                        <x-input-error :messages="$errors->get('keterangan')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="urutan" value="Urutan" />
                        <input type="number" id="urutan" name="urutan" value="{{ old('urutan', $data->urutan ?? 0) }}" min="0" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan urutan tampilan..." />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Angka menentukan posisi tampilan (0 = paling atas)</p>
                        <x-input-error :messages="$errors->get('urutan')" class="mt-1" />
                    </div>

                    <div class="flex items-end">
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_wajib" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-2 focus:ring-blue-500/20" @checked(old('is_wajib', $data->is_wajib))>
                            <span class="text-sm font-medium text-gray-700">Dokumen wajib</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-5 border-t border-gray-200">
                    <x-secondary-button type="button" onclick="window.location='{{ route('admin.dokumen-persyaratan.index') }}'">Batal</x-secondary-button>
                    <x-primary-button type="submit">Update</x-primary-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
