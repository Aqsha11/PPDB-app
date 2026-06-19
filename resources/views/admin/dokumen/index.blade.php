<x-app-layout>
    <x-slot name="header">Persyaratan Dokumen</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Persyaratan Dokumen'],
        ]" />

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2">
                <x-card title="Daftar Persyaratan Dokumen">
                    <x-table :headers="['Nama Dokumen', 'Jalur Pendaftaran', 'Keterangan', 'Aksi']">
                        @forelse($data as $item)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $item->nama_dokumen }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $item->jalurPendaftaran->nama_jalur ?? 'Semua Jalur' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600 max-w-xs truncate">
                                    {{ $item->keterangan ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <form action="{{ route('admin.dokumen-persyaratan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus persyaratan ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <x-empty-state title="Belum ada persyaratan dokumen" description="Tambahkan persyaratan dokumen baru." />
                                </td>
                            </tr>
                        @endforelse
                    </x-table>
                </x-card>
            </div>

            <div>
                <x-card title="Tambah Persyaratan">
                    <form action="{{ route('admin.dokumen-persyaratan.store') }}" method="POST">
                        @csrf

                        <div class="space-y-4">
                            <div>
                                <x-input-label for="jalur_pendaftaran_id" value="Jalur Pendaftaran" />
                                <select id="jalur_pendaftaran_id" name="jalur_pendaftaran_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">-- Semua Jalur --</option>
                                    @foreach(\App\Models\JalurPendaftaran::all() as $jp)
                                        <option value="{{ $jp->id }}" {{ old('jalur_pendaftaran_id') == $jp->id ? 'selected' : '' }}>{{ $jp->nama_jalur }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('jalur_pendaftaran_id')" class="mt-1" />
                            </div>

                            <div>
                                <x-input-label for="nama_dokumen" value="Nama Dokumen" />
                                <input type="text" id="nama_dokumen" name="nama_dokumen" value="{{ old('nama_dokumen') }}" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Contoh: Ijazah" required />
                                <x-input-error :messages="$errors->get('nama_dokumen')" class="mt-1" />
                            </div>

                            <div>
                                <x-input-label for="keterangan" value="Keterangan" />
                                <textarea id="keterangan" name="keterangan" rows="2" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Keterangan dokumen...">{{ old('keterangan') }}</textarea>
                                <x-input-error :messages="$errors->get('keterangan')" class="mt-1" />
                            </div>

                            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Simpan
                            </button>
                        </div>
                    </form>
                </x-card>
            </div>
        </div>
    </div>
</x-app-layout>
