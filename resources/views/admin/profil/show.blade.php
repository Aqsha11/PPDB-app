<x-app-layout>
    <x-slot name="header">Detail Profil Sekolah</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Profil Sekolah', 'url' => route('admin.profil.index')],
            ['label' => 'Detail'],
        ]" />

        <x-admin.module-header title="Detail Profil Sekolah" description="Lihat detail informasi profil sekolah.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </x-slot>
            <x-slot name="actions">
                <x-primary-button href="{{ route('admin.profil.edit') }}">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                    Edit Profil
                </x-primary-button>
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <x-slot name="title">Informasi Dasar</x-slot>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <x-input-label value="Nama Sekolah" />
                    <p class="mt-1 text-sm text-gray-900 font-medium">{{ $data->nama_sekolah ?? '-' }}</p>
                </div>
                <div>
                    <x-input-label value="NPSN" />
                    <p class="mt-1 text-sm text-gray-900">{{ $data->npsn ?? '-' }}</p>
                </div>
                <div class="md:col-span-2">
                    <x-input-label value="Alamat" />
                    <p class="mt-1 text-sm text-gray-900">{{ $data->alamat ?? '-' }}</p>
                </div>
                <div>
                    <x-input-label value="Kelurahan" />
                    <p class="mt-1 text-sm text-gray-900">{{ $data->kelurahan ?? '-' }}</p>
                </div>
                <div>
                    <x-input-label value="Kecamatan" />
                    <p class="mt-1 text-sm text-gray-900">{{ $data->kecamatan ?? '-' }}</p>
                </div>
                <div>
                    <x-input-label value="Kota" />
                    <p class="mt-1 text-sm text-gray-900">{{ $data->kota ?? '-' }}</p>
                </div>
                <div>
                    <x-input-label value="Provinsi" />
                    <p class="mt-1 text-sm text-gray-900">{{ $data->provinsi ?? '-' }}</p>
                </div>
                <div>
                    <x-input-label value="Kode Pos" />
                    <p class="mt-1 text-sm text-gray-900">{{ $data->kode_pos ?? '-' }}</p>
                </div>
                @if($data->foto_sekolah ?? null)
                <div>
                    <x-input-label value="Foto Sekolah" />
                    <img src="{{ Storage::url($data->foto_sekolah) }}" alt="Foto Sekolah" class="mt-2 rounded-lg max-w-sm h-40 object-cover shadow">
                </div>
                @endif
            </div>
        </x-card>

        <x-card>
            <x-slot name="title">Kontak</x-slot>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <x-input-label value="Telepon" />
                    <p class="mt-1 text-sm text-gray-900">{{ $data->telepon ?? '-' }}</p>
                </div>
                <div>
                    <x-input-label value="Email" />
                    <p class="mt-1 text-sm text-gray-900">{{ $data->email ?? '-' }}</p>
                </div>
                <div>
                    <x-input-label value="WhatsApp" />
                    <p class="mt-1 text-sm text-gray-900">{{ $data->whatsapp ?? '-' }}</p>
                </div>
            </div>
        </x-card>

        <x-card>
            <x-slot name="title">Deskripsi & Visi Misi</x-slot>
            <div class="space-y-6">
                <div>
                    <x-input-label value="Deskripsi Sekolah" />
                    <p class="mt-1 text-sm text-gray-900">{{ $data->deskripsi ?? '-' }}</p>
                </div>
                <div>
                    <x-input-label value="Visi" />
                    <div class="mt-1 text-sm text-gray-900 whitespace-pre-line bg-gray-50 rounded-lg p-4">{{ $data->visi ?? '-' }}</div>
                </div>
                <div>
                    <x-input-label value="Misi" />
                    <div class="mt-1 text-sm text-gray-900 whitespace-pre-line bg-gray-50 rounded-lg p-4">{{ $data->misi ?? '-' }}</div>
                </div>
                @if($data->warna_primary ?? null)
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <x-input-label value="Warna Primer" />
                        <div class="mt-2 flex items-center gap-2">
                            <div class="w-8 h-8 rounded-lg shadow border" style="background-color: {{ $data->warna_primary }}"></div>
                            <span class="text-sm text-gray-600 font-mono">{{ $data->warna_primary }}</span>
                        </div>
                    </div>
                    <div>
                        <x-input-label value="Warna Sekunder" />
                        <div class="mt-2 flex items-center gap-2">
                            <div class="w-8 h-8 rounded-lg shadow border" style="background-color: {{ $data->warna_second ?? '#ffffff' }}"></div>
                            <span class="text-sm text-gray-600 font-mono">{{ $data->warna_second ?? '-' }}</span>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </x-card>
    </div>
</x-app-layout>
