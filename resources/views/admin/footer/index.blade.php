<x-app-layout>
    <x-slot name="header">Footer</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[['label' => 'Dashboard', 'route' => 'admin.dashboard'], ['label' => 'Footer']]" />

        <x-card>
            <form action="{{ route('admin.footer.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi</label>
                        <textarea name="deskripsi" rows="4" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>{{ old('deskripsi', $data->deskripsi ?? '') }}</textarea>
                        @error('deskripsi') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Logo</label>
                        @if($data->logo ?? null)
                            <div class="mb-3">
                                <img src="{{ Storage::url($data->logo) }}" class="w-24 h-24 object-cover rounded-lg border border-gray-200">
                            </div>
                        @endif
                        <input type="file" name="logo" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        @error('logo') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Copyright Text</label>
                        <input type="text" name="copyright_text" value="{{ old('copyright_text', $data->copyright_text ?? $data->copyright ?? '') }}" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" required placeholder="&copy; {{ date('Y') }} Nama Sekolah. All rights reserved.">
                        @error('copyright_text') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Alamat</label>
                        <input type="text" name="alamat" value="{{ old('alamat', $data->alamat ?? '') }}" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('alamat') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                        <input type="email" name="email" value="{{ old('email', $data->email ?? '') }}" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Telepon</label>
                        <input type="text" name="telepon" value="{{ old('telepon', $data->telepon ?? '') }}" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('telepon') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex justify-end pt-4 border-t border-gray-100">
                    <x-primary-button type="submit">Simpan</x-primary-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
