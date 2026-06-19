<x-app-layout>
    <x-slot name="header">Data Pribadi</x-slot>

    <x-card title="Form Data Pribadi">
        @if($errors->any())
            <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('siswa.biodata.update') }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <x-input-label for="nama_lengkap" value="Nama Lengkap" />
                    <x-text-input id="nama_lengkap" name="nama_lengkap" type="text" class="mt-1 block w-full" :value="old('nama_lengkap', $siswa->nama_lengkap)" required />
                    <x-input-error :messages="$errors->get('nama_lengkap')" class="mt-1" />
                </div>

                <div>
                    <x-input-label for="nisn" value="NISN" />
                    <x-text-input id="nisn" name="nisn" type="text" class="mt-1 block w-full" :value="old('nisn', $siswa->nisn)" required />
                    <x-input-error :messages="$errors->get('nisn')" class="mt-1" />
                </div>

                <div>
                    <x-input-label for="tempat_lahir" value="Tempat Lahir" />
                    <x-text-input id="tempat_lahir" name="tempat_lahir" type="text" class="mt-1 block w-full" :value="old('tempat_lahir', $siswa->tempat_lahir)" required />
                    <x-input-error :messages="$errors->get('tempat_lahir')" class="mt-1" />
                </div>

                <div>
                    <x-input-label for="tanggal_lahir" value="Tanggal Lahir" />
                    <x-text-input id="tanggal_lahir" name="tanggal_lahir" type="date" class="mt-1 block w-full" :value="old('tanggal_lahir', $siswa->tanggal_lahir?->format('Y-m-d'))" required />
                    <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-1" />
                </div>

                <div>
                    <x-input-label for="jenis_kelamin" value="Jenis Kelamin" />
                    <select id="jenis_kelamin" name="jenis_kelamin" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L" {{ old('jenis_kelamin', $siswa->jenis_kelamin) === 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin', $siswa->jenis_kelamin) === 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-1" />
                </div>

                <div>
                    <x-input-label for="no_hp" value="No. Handphone" />
                    <x-text-input id="no_hp" name="no_hp" type="text" class="mt-1 block w-full" :value="old('no_hp', $siswa->no_hp)" required />
                    <x-input-error :messages="$errors->get('no_hp')" class="mt-1" />
                </div>

                <div class="md:col-span-2">
                    <x-input-label for="alamat" value="Alamat" />
                    <textarea id="alamat" name="alamat" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('alamat', $siswa->alamat) }}</textarea>
                    <x-input-error :messages="$errors->get('alamat')" class="mt-1" />
                </div>
            </div>

            <div class="mt-6 flex items-center gap-3">
                <x-primary-button>Simpan Biodata</x-primary-button>
                <a href="{{ route('siswa.dashboard') }}" class="text-sm text-gray-600 hover:underline">Batal</a>
            </div>
        </form>
    </x-card>
</x-app-layout>
