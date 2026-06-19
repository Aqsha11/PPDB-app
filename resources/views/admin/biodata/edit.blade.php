<x-app-layout>
    <x-slot name="header">Edit Biodata Siswa</x-slot>

    <div class="mb-6 space-y-4">
        <x-breadcrumb :items="[
            ['label' => 'Home', 'url' => route('admin.dashboard')],
            ['label' => 'Biodata Siswa', 'url' => route('admin.biodata.index')],
            ['label' => 'Edit'],
        ]" />
    </div>

    <x-card>
        <form action="{{ route('admin.biodata.update', $siswa->id) }}" method="POST">
            @csrf @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="nisn" class="block text-sm font-medium text-gray-700 mb-1">NISN</label>
                    <input type="text" id="nisn" name="nisn" value="{{ old('nisn', $siswa->nisn) }}" maxlength="10" class="w-full rounded-lg border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent px-4 py-2.5 text-sm">
                    @error('nisn') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-1">No HP</label>
                    <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp', $siswa->no_hp) }}" class="w-full rounded-lg border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent px-4 py-2.5 text-sm">
                    @error('no_hp') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                    <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}" class="w-full rounded-lg border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent px-4 py-2.5 text-sm">
                    @error('tempat_lahir') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $siswa->tanggal_lahir?->format('Y-m-d')) }}" class="w-full rounded-lg border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent px-4 py-2.5 text-sm">
                    @error('tanggal_lahir') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" class="w-full rounded-lg border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent px-4 py-2.5 text-sm">
                        <option value="">-- Pilih --</option>
                        <option value="L" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="agama" class="block text-sm font-medium text-gray-700 mb-1">Agama</label>
                    <select id="agama" name="agama" class="w-full rounded-lg border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent px-4 py-2.5 text-sm">
                        <option value="">-- Pilih --</option>
                        @foreach(['Islam', 'Kristen Protestan', 'Kristen Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $agama)
                            <option value="{{ $agama }}" {{ old('agama', $siswa->agama) == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                        @endforeach
                    </select>
                    @error('agama') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                    <textarea id="alamat" name="alamat" rows="3" class="w-full rounded-lg border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent px-4 py-2.5 text-sm">{{ old('alamat', $siswa->alamat) }}</textarea>
                    @error('alamat') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex items-center gap-3 mt-6 pt-6 border-t border-gray-100">
                <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">Simpan</button>
                <a href="{{ route('admin.biodata.index') }}" class="inline-flex items-center px-6 py-2.5 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">Batal</a>
            </div>
        </form>
    </x-card>
</x-app-layout>
