<x-app-layout>
    <x-slot name="header">Profil Sekolah</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[['label' => 'Dashboard', 'route' => 'admin.dashboard'], ['label' => 'Profil Sekolah']]" />

        <x-card>
            <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Sekolah</label>
                        <input type="text" name="nama_sekolah" value="{{ old('nama_sekolah', $data->nama_sekolah ?? '') }}" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        @error('nama_sekolah') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">NPSN</label>
                        <input type="text" name="npsn" value="{{ old('npsn', $data->npsn ?? '') }}" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('npsn') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Kelurahan</label>
                        <input type="text" name="kelurahan" value="{{ old('kelurahan', $data->kelurahan ?? '') }}" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('kelurahan') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Kecamatan</label>
                        <input type="text" name="kecamatan" value="{{ old('kecamatan', $data->kecamatan ?? '') }}" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('kecamatan') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Kota</label>
                        <input type="text" name="kota" value="{{ old('kota', $data->kota ?? '') }}" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('kota') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Provinsi</label>
                        <input type="text" name="provinsi" value="{{ old('provinsi', $data->provinsi ?? '') }}" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('provinsi') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Kode Pos</label>
                        <input type="text" name="kode_pos" value="{{ old('kode_pos', $data->kode_pos ?? '') }}" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('kode_pos') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Telepon</label>
                        <input type="text" name="telepon" value="{{ old('telepon', $data->telepon ?? '') }}" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('telepon') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                        <input type="email" name="email" value="{{ old('email', $data->email ?? '') }}" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Website</label>
                        <input type="url" name="website" value="{{ old('website', $data->website ?? '') }}" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('website') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Alamat</label>
                    <textarea name="alamat" rows="3" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('alamat', $data->alamat ?? '') }}</textarea>
                    @error('alamat') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Logo</label>
                    @if($data->logo ?? null)
                        <div class="mb-3">
                            <img src="{{ Storage::url($data->logo) }}" class="w-32 h-32 object-cover rounded-lg border border-gray-200">
                        </div>
                    @endif
                    <input type="file" name="logo" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    @error('logo') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Visi</label>
                    <textarea name="visi" rows="4" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('visi', $data->visi ?? '') }}</textarea>
                    @error('visi') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Misi</label>
                    <textarea name="misi" rows="6" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('misi', $data->misi ?? '') }}</textarea>
                    @error('misi') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end pt-4 border-t border-gray-100">
                    <x-primary-button type="submit">Simpan</x-primary-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
