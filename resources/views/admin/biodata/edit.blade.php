<x-app-layout>
    <x-slot name="header">Edit Biodata Peserta</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Biodata Peserta', 'url' => route('admin.biodata.index')],
            ['label' => 'Edit'],
        ]" />

        <x-admin.module-header title="Edit Biodata Peserta" description="Perbarui data biodata peserta yang sudah terdaftar.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <form action="{{ route('admin.biodata.update', $peserta) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <x-input-label for="nama_lengkap" value="Nama Lengkap" />
                            <x-text-input type="text" id="nama_lengkap" name="nama_lengkap" :value="old('nama_lengkap', $peserta->nama_lengkap)" class="mt-1" required />
                            <x-input-error :messages="$errors->get('nama_lengkap')" class="mt-1.5" />
                        </div>
                        <div>
                            <x-input-label for="nisn" value="NISN" />
                            <x-text-input type="text" id="nisn" name="nisn" :value="old('nisn', $peserta->nisn)" class="mt-1" maxlength="10" />
                            <x-input-error :messages="$errors->get('nisn')" class="mt-1.5" />
                        </div>
                        <div>
                            <x-input-label for="nik" value="NIK" />
                            <x-text-input type="text" id="nik" name="nik" :value="old('nik', $peserta->nik)" class="mt-1" maxlength="16" />
                            <x-input-error :messages="$errors->get('nik')" class="mt-1.5" />
                        </div>
                        <div>
                            <x-input-label for="no_hp" value="No HP" />
                            <x-text-input type="text" id="no_hp" name="no_hp" :value="old('no_hp', $peserta->no_hp)" class="mt-1" />
                            <x-input-error :messages="$errors->get('no_hp')" class="mt-1.5" />
                        </div>
                        <div>
                            <x-input-label for="tempat_lahir" value="Tempat Lahir" />
                            <x-text-input type="text" id="tempat_lahir" name="tempat_lahir" :value="old('tempat_lahir', $peserta->tempat_lahir)" class="mt-1" />
                            <x-input-error :messages="$errors->get('tempat_lahir')" class="mt-1.5" />
                        </div>
                        <div>
                            <x-input-label for="tanggal_lahir" value="Tanggal Lahir" />
                            <x-text-input type="date" id="tanggal_lahir" name="tanggal_lahir" :value="old('tanggal_lahir', $peserta->tanggal_lahir?->format('Y-m-d'))" class="mt-1" />
                            <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-1.5" />
                        </div>
                        <div>
                            <x-input-label for="jenis_kelamin" value="Jenis Kelamin" />
                            <select id="jenis_kelamin" name="jenis_kelamin" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm transition-colors">
                                <option value="">-- Pilih --</option>
                                <option value="L" {{ old('jenis_kelamin', $peserta->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin', $peserta->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-1.5" />
                        </div>
                        <div>
                            <x-input-label for="agama" value="Agama" />
                            <select id="agama" name="agama" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm transition-colors">
                                <option value="">-- Pilih --</option>
                                @foreach(['Islam', 'Kristen Protestan', 'Kristen Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $agama)
                                    <option value="{{ $agama }}" {{ old('agama', $peserta->agama) == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('agama')" class="mt-1.5" />
                        </div>
                        <div class="md:col-span-2">
                            <x-input-label for="alamat" value="Alamat" />
                            <textarea id="alamat" name="alamat" rows="3" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm transition-colors">{{ old('alamat', $peserta->alamat) }}</textarea>
                            <x-input-error :messages="$errors->get('alamat')" class="mt-1.5" />
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100 dark:border-slate-700">
                    <x-secondary-button href="{{ route('admin.biodata.index') }}">Batal</x-secondary-button>
                    <x-primary-button type="submit">Simpan</x-primary-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
