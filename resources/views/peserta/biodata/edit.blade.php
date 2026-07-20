@extends('layouts.peserta')

@section('header', 'Biodata')

@section('content')
    <div class="animate-fade-in">
        <x-card>
            <form method="POST" action="{{ route('peserta.biodata.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-8">
                    <div>
                        <div class="flex items-center gap-3 mb-5 pb-4 border-b border-gray-100 dark:border-slate-800">
                            <div class="w-10 h-10 rounded-xl theme-bg-light flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 theme-text" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <h3 class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-wider">Pas Foto</h3>
                        </div>
                        <div class="flex flex-col sm:flex-row items-start gap-6">
                            <div class="shrink-0">
                                <div id="preview-container" class="w-32 h-40 rounded-2xl border-2 border-dashed border-gray-300 dark:border-slate-600 overflow-hidden bg-gray-50 dark:bg-slate-800 flex items-center justify-center transition-all hover:border-gray-400 dark:hover:border-slate-500">
                                    @if($peserta->pas_foto)
                                        <img id="preview-image" src="{{ Storage::url($peserta->pas_foto) }}" alt="Pas Foto" class="w-full h-full object-cover">
                                    @else
                                        <img id="preview-image" src="" alt="" class="w-full h-full object-cover hidden">
                                        <div id="preview-placeholder" class="text-center">
                                            <svg class="w-10 h-10 text-gray-300 dark:text-slate-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                            <p class="text-xs text-gray-400 mt-1">3x4</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="flex-1">
                                <x-input-label for="pas_foto" value="Upload Pas Foto (3x4)" />
                                <input type="file" id="pas_foto" name="pas_foto" accept="image/*"
                                       class="mt-1.5 block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-theme-bg-light file:theme-text hover:file:opacity-80 file:transition-all file:cursor-pointer"
                                       onchange="previewPhoto(event)">
                                <p class="mt-1.5 text-xs text-gray-400 dark:text-slate-500">Format: JPG, JPEG, PNG. Maksimal 2MB.</p>
                                <x-input-error :messages="$errors->get('pas_foto')" class="mt-1" />
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center gap-3 mb-5 pb-4 border-b border-gray-100 dark:border-slate-800">
                            <div class="w-10 h-10 rounded-xl theme-bg-light flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 theme-text" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <h3 class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-wider">Data Pribadi</h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <x-input-label for="nama_lengkap" value="Nama Lengkap" />
                                <x-text-input id="nama_lengkap" name="nama_lengkap" type="text" class="mt-1.5 block w-full" :value="old('nama_lengkap', $peserta->nama_lengkap)" placeholder="Masukkan nama lengkap" required />
                                <x-input-error :messages="$errors->get('nama_lengkap')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="nisn" value="NISN" />
                                <x-text-input id="nisn" name="nisn" type="text" class="mt-1.5 block w-full" :value="old('nisn', $peserta->nisn)" placeholder="Masukkan 10 digit NISN" required />
                                <p class="mt-1 text-xs text-gray-400 dark:text-slate-500">Minimal 10 karakter, angka saja</p>
                                <x-input-error :messages="$errors->get('nisn')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="nik" value="NIK" />
                                <x-text-input id="nik" name="nik" type="text" class="mt-1.5 block w-full" :value="old('nik', $peserta->nik)" placeholder="Masukkan 16 digit NIK" maxlength="16" />
                                <p class="mt-1 text-xs text-gray-400 dark:text-slate-500">16 karakter, angka saja</p>
                                <x-input-error :messages="$errors->get('nik')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="tempat_lahir" value="Tempat Lahir" />
                                <x-text-input id="tempat_lahir" name="tempat_lahir" type="text" class="mt-1.5 block w-full" :value="old('tempat_lahir', $peserta->tempat_lahir)" placeholder="Contoh: Makassar" required />
                                <x-input-error :messages="$errors->get('tempat_lahir')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="tanggal_lahir" value="Tanggal Lahir" />
                                <x-text-input id="tanggal_lahir" name="tanggal_lahir" type="date" class="mt-1.5 block w-full" :value="old('tanggal_lahir', $peserta->tanggal_lahir?->format('Y-m-d'))" required />
                                <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="jenis_kelamin" value="Jenis Kelamin" />
                                <select id="jenis_kelamin" name="jenis_kelamin" class="mt-1.5 block w-full border-gray-300 dark:border-slate-600 dark:bg-slate-800 focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)] rounded-xl" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L" {{ old('jenis_kelamin', $peserta->jenis_kelamin) === 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin', $peserta->jenis_kelamin) === 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="agama" value="Agama" />
                                <x-text-input id="agama" name="agama" type="text" class="mt-1.5 block w-full" :value="old('agama', $peserta->agama)" placeholder="Contoh: Islam" />
                                <x-input-error :messages="$errors->get('agama')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="no_hp" value="No. Handphone" />
                                <x-text-input id="no_hp" name="no_hp" type="text" class="mt-1.5 block w-full" :value="old('no_hp', $peserta->no_hp)" placeholder="Contoh: 081234567890" required />
                                <x-input-error :messages="$errors->get('no_hp')" class="mt-1" />
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center gap-3 mb-5 pb-4 border-b border-gray-100 dark:border-slate-800">
                            <div class="w-10 h-10 rounded-xl theme-bg-light flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 theme-text" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-wider">Alamat</h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <x-input-label for="alamat" value="Alamat Lengkap" />
                                <textarea id="alamat" name="alamat" rows="3" class="mt-1.5 block w-full border-gray-300 dark:border-slate-600 dark:bg-slate-800 focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)] rounded-xl" placeholder="Masukkan alamat lengkap" required>{{ old('alamat', $peserta->alamat) }}</textarea>
                                <x-input-error :messages="$errors->get('alamat')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="provinsi" value="Provinsi" />
                                <x-text-input id="provinsi" name="provinsi" type="text" class="mt-1.5 block w-full" :value="old('provinsi', $peserta->provinsi)" placeholder="Contoh: Sulawesi Selatan" />
                                <x-input-error :messages="$errors->get('provinsi')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="kabupaten" value="Kabupaten/Kota" />
                                <x-text-input id="kabupaten" name="kabupaten" type="text" class="mt-1.5 block w-full" :value="old('kabupaten', $peserta->kabupaten)" placeholder="Contoh: Makassar" />
                                <x-input-error :messages="$errors->get('kabupaten')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="kecamatan" value="Kecamatan" />
                                <x-text-input id="kecamatan" name="kecamatan" type="text" class="mt-1.5 block w-full" :value="old('kecamatan', $peserta->kecamatan)" placeholder="Contoh: Tamalanrea" />
                                <x-input-error :messages="$errors->get('kecamatan')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="kelurahan" value="Kelurahan/Desa" />
                                <x-text-input id="kelurahan" name="kelurahan" type="text" class="mt-1.5 block w-full" :value="old('kelurahan', $peserta->kelurahan)" placeholder="Contoh: Buntara" />
                                <x-input-error :messages="$errors->get('kelurahan')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="kode_pos" value="Kode Pos" />
                                <x-text-input id="kode_pos" name="kode_pos" type="text" class="mt-1.5 block w-full" :value="old('kode_pos', $peserta->kode_pos)" placeholder="Contoh: 90231" maxlength="5" />
                                <x-input-error :messages="$errors->get('kode_pos')" class="mt-1" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100 dark:border-slate-800 flex flex-wrap items-center gap-3">
                    <x-primary-button>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Biodata
                    </x-primary-button>
                    <x-secondary-button onclick="window.location='{{ route('peserta.dashboard') }}'">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Batal
                    </x-secondary-button>
                </div>
            </form>
        </x-card>
    </div>

    <script>
        function previewPhoto(event) {
            const file = event.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('preview-image');
                const placeholder = document.getElementById('preview-placeholder');
                img.src = e.target.result;
                img.classList.remove('hidden');
                if (placeholder) placeholder.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }
    </script>
@endsection
