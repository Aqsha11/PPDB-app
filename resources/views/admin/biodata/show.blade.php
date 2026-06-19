<x-app-layout>
    <x-slot name="header">Detail Biodata Siswa</x-slot>

    <div class="mb-6 space-y-4">
        <x-breadcrumb :items="[
            ['label' => 'Home', 'url' => route('admin.dashboard')],
            ['label' => 'Biodata Siswa', 'url' => route('admin.biodata.index')],
            ['label' => 'Detail'],
        ]" />

        <div class="flex items-center gap-2">
            <a href="{{ route('admin.biodata.edit', $siswa->id) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                Edit
            </a>
            <a href="{{ route('admin.biodata.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                &larr; Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <x-card title="Data Pribadi">
            <dl class="divide-y divide-gray-100">
                <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">NISN</dt>
                    <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $siswa->nisn ?? '-' }}</dd>
                </div>
                <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">Nama</dt>
                    <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 font-semibold">{{ $siswa->user->name ?? $siswa->nama_lengkap }}</dd>
                </div>
                <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                    <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $siswa->user->email ?? '-' }}</dd>
                </div>
                <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">No HP</dt>
                    <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $siswa->no_hp ?? '-' }}</dd>
                </div>
                <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">Tempat Lahir</dt>
                    <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $siswa->tempat_lahir ?? '-' }}</dd>
                </div>
                <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">Tanggal Lahir</dt>
                    <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $siswa->tanggal_lahir ? $siswa->tanggal_lahir->format('d/m/Y') : '-' }}</dd>
                </div>
                <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">Jenis Kelamin</dt>
                    <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : ($siswa->jenis_kelamin == 'P' ? 'Perempuan' : '-') }}</dd>
                </div>
                <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">Agama</dt>
                    <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $siswa->agama ?? '-' }}</dd>
                </div>
                <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                    <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $siswa->alamat ?? '-' }}</dd>
                </div>
            </dl>
        </x-card>

        <div class="space-y-6">
            @if($siswa->orangTua)
                <x-card title="Data Orang Tua">
                    <dl class="divide-y divide-gray-100">
                        <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">Nama Ayah</dt>
                            <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $siswa->orangTua->nama_ayah ?? '-' }}</dd>
                        </div>
                        <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">Pekerjaan Ayah</dt>
                            <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $siswa->orangTua->pekerjaan_ayah ?? '-' }}</dd>
                        </div>
                        <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">Nama Ibu</dt>
                            <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $siswa->orangTua->nama_ibu ?? '-' }}</dd>
                        </div>
                        <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">Pekerjaan Ibu</dt>
                            <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $siswa->orangTua->pekerjaan_ibu ?? '-' }}</dd>
                        </div>
                        <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">No HP</dt>
                            <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $siswa->orangTua->no_hp ?? '-' }}</dd>
                        </div>
                        <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                            <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $siswa->orangTua->alamat ?? '-' }}</dd>
                        </div>
                    </dl>
                </x-card>
            @endif

            @if($siswa->sekolahAsal)
                <x-card title="Data Sekolah Asal">
                    <dl class="divide-y divide-gray-100">
                        <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">Nama Sekolah</dt>
                            <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $siswa->sekolahAsal->nama_sekolah ?? '-' }}</dd>
                        </div>
                        <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                            <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $siswa->sekolahAsal->alamat ?? '-' }}</dd>
                        </div>
                        <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">Tahun Lulus</dt>
                            <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $siswa->sekolahAsal->tahun_lulus ?? '-' }}</dd>
                        </div>
                    </dl>
                </x-card>
            @endif

            @if($siswa->pendaftaran)
                <x-card title="Data Pendaftaran">
                    <dl class="divide-y divide-gray-100">
                        <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">Nomor Pendaftaran</dt>
                            <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $siswa->pendaftaran->nomor_pendaftaran ?? '-' }}</dd>
                        </div>
                        <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">Jalur</dt>
                            <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $siswa->pendaftaran->jalurPendaftaran->nama ?? '-' }}</dd>
                        </div>
                        <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">Status</dt>
                            <dd class="mt-1 sm:mt-0 sm:col-span-2">
                                @php
                                    $statusColors = [
                                        'draft' => 'gray',
                                        'submitted' => 'yellow',
                                        'verifikasi' => 'blue',
                                        'diterima' => 'green',
                                        'cadangan' => 'yellow',
                                        'ditolak' => 'red',
                                    ];
                                    $color = $statusColors[$siswa->pendaftaran->status_pendaftaran] ?? 'gray';
                                @endphp
                                <x-badge :color="$color">{{ ucfirst($siswa->pendaftaran->status_pendaftaran) }}</x-badge>
                            </dd>
                        </div>
                    </dl>
                </x-card>
            @endif
        </div>
    </div>
</x-app-layout>
