<x-app-layout>
    <x-slot name="header">Edit Profil Sekolah</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Profil Sekolah', 'url' => route('admin.profil.index')],
            ['label' => 'Edit'],
        ]" />

        <x-admin.module-header title="Edit Profil Sekolah" description="Perbarui informasi profil sekolah yang ditampilkan di halaman publik.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </x-slot>
        </x-admin.module-header>

        <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="space-y-6">
                <x-card>
                    <x-slot name="title">Informasi Dasar</x-slot>
                    <div class="space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <x-input-label for="nama_sekolah" value="* Nama Sekolah" />
                                <input type="text" id="nama_sekolah" name="nama_sekolah" value="{{ old('nama_sekolah', $data->nama_sekolah ?? '') }}" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan nama sekolah..." required />
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Maksimal 255 karakter</p>
                                <x-input-error :messages="$errors->get('nama_sekolah')" class="mt-1" />
                            </div>

                            <div>
                                <x-input-label for="npsn" value="NPSN" />
                                <input type="text" id="npsn" name="npsn" value="{{ old('npsn', $data->npsn ?? '') }}" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan NPSN..." />
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Nomor Pokok Sekolah Nasional (8 digit)</p>
                                <x-input-error :messages="$errors->get('npsn')" class="mt-1" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="alamat" value="* Alamat" />
                            <textarea id="alamat" name="alamat" rows="3" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan alamat lengkap sekolah..." required>{{ old('alamat', $data->alamat ?? '') }}</textarea>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Alamat lengkap termasuk nama jalan dan nomor</p>
                            <x-input-error :messages="$errors->get('alamat')" class="mt-1" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                            <div>
                                <x-input-label for="kelurahan" value="Kelurahan" />
                                <input type="text" id="kelurahan" name="kelurahan" value="{{ old('kelurahan', $data->kelurahan ?? '') }}" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan nama kelurahan..." />
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Nama kelurahan/desa</p>
                                <x-input-error :messages="$errors->get('kelurahan')" class="mt-1" />
                            </div>

                            <div>
                                <x-input-label for="kecamatan" value="Kecamatan" />
                                <input type="text" id="kecamatan" name="kecamatan" value="{{ old('kecamatan', $data->kecamatan ?? '') }}" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan nama kecamatan..." />
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Nama kecamatan</p>
                                <x-input-error :messages="$errors->get('kecamatan')" class="mt-1" />
                            </div>

                            <div>
                                <x-input-label for="kota" value="Kota" />
                                <input type="text" id="kota" name="kota" value="{{ old('kota', $data->kota ?? '') }}" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan nama kota/kabupaten..." />
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Nama kota atau kabupaten</p>
                                <x-input-error :messages="$errors->get('kota')" class="mt-1" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                            <div>
                                <x-input-label for="provinsi" value="Provinsi" />
                                <input type="text" id="provinsi" name="provinsi" value="{{ old('provinsi', $data->provinsi ?? '') }}" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan nama provinsi..." />
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Nama provinsi</p>
                                <x-input-error :messages="$errors->get('provinsi')" class="mt-1" />
                            </div>

                            <div>
                                <x-input-label for="kode_pos" value="Kode Pos" />
                                <input type="text" id="kode_pos" name="kode_pos" value="{{ old('kode_pos', $data->kode_pos ?? '') }}" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan kode pos..." />
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">5 digit angka</p>
                                <x-input-error :messages="$errors->get('kode_pos')" class="mt-1" />
                            </div>

                            <div>
                                <x-input-label for="foto_sekolah" value="Foto Sekolah" />
                                @if($data->foto_sekolah ?? null)
                                    <x-image-cropper name="foto_sekolah" id="foto_sekolah" preview="{{ Storage::url($data->foto_sekolah) }}" />
                                @else
                                    <x-image-cropper name="foto_sekolah" id="foto_sekolah" />
                                @endif
                                <p class="mt-1 text-xs text-gray-400">Foto bangunan atau lingkungan sekolah</p>
                                <x-input-error :messages="$errors->get('foto_sekolah')" class="mt-1" />
                            </div>
                        </div>
                    </div>
                </x-card>

                <x-card>
                    <x-slot name="title">Kontak</x-slot>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div>
                            <x-input-label for="telepon" value="Telepon" />
                            <input type="text" id="telepon" name="telepon" value="{{ old('telepon', $data->telepon ?? '') }}" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan nomor telepon..." />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Contoh: (0411) 123456</p>
                            <x-input-error :messages="$errors->get('telepon')" class="mt-1" />
                        </div>

                        <div>
                            <x-input-label for="email" value="Email" />
                            <input type="email" id="email" name="email" value="{{ old('email', $data->email ?? '') }}" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan email sekolah..." />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Format: nama@domain.com</p>
                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>

                        <div>
                            <x-input-label for="whatsapp" value="WhatsApp" />
                            <input type="text" id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $data->whatsapp ?? '') }}" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="6281234567890" />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Format: 628xxxxxxxxxx (kode negara + nomor)</p>
                            <x-input-error :messages="$errors->get('whatsapp')" class="mt-1" />
                        </div>
                    </div>
                </x-card>

                <x-card>
                    <x-slot name="title">Deskripsi & Visi Misi</x-slot>
                    <div class="space-y-5">
                        <div>
                            <x-input-label for="deskripsi" value="* Deskripsi Sekolah" />
                            <textarea id="deskripsi" name="deskripsi" rows="4" maxlength="255" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan deskripsi singkat sekolah..." required>{{ old('deskripsi', $data->deskripsi ?? '') }}</textarea>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Maksimal 255 karakter</p>
                            <x-input-error :messages="$errors->get('deskripsi')" class="mt-1" />
                        </div>

                        <div>
                            <x-input-label for="visi" value="Visi" />
                            <textarea id="visi" name="visi" rows="4" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan visi sekolah...">{{ old('visi', $data->visi ?? '') }}</textarea>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Visi jangka panjang sekolah</p>
                            <x-input-error :messages="$errors->get('visi')" class="mt-1" />
                        </div>

                        <div>
                            <x-input-label for="misi" value="Misi" />
                            <textarea id="misi" name="misi" rows="6" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan misi sekolah...">{{ old('misi', $data->misi ?? '') }}</textarea>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Rencana aksi untuk mencapai visi</p>
                            <x-input-error :messages="$errors->get('misi')" class="mt-1" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 mt-6 pt-6 border-t border-gray-200 dark:border-slate-700">
                        <x-secondary-button type="button" onclick="window.location='{{ route('admin.profil.index') }}'">Batal</x-secondary-button>
                        <x-primary-button type="submit">Simpan Perubahan</x-primary-button>
                    </div>
                </x-card>
            </div>
        </form>
    </div>
</x-app-layout>
