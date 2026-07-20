<x-app-layout>
    <x-slot name="header">Detail Biodata Peserta</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Biodata Peserta', 'url' => route('admin.biodata.index')],
            ['label' => 'Detail'],
        ]" />

        <div class="flex items-center gap-2">
            <x-icon-button :href="route('admin.biodata.index')" variant="default" title="Kembali">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </x-icon-button>
            <x-icon-button :href="route('admin.biodata.edit', $peserta)" variant="warning" title="Ubah">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            </x-icon-button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <x-card>
                <div class="px-5 py-4 border-b border-gray-100 dark:border-slate-700">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Data Pribadi</h3>
                </div>
                <div class="p-5">
                    <dl class="space-y-4">
                        @php
                            $fields = [
                                ['NISN', $peserta->nisn],
                                ['Nama', $peserta->user->name ?? $peserta->nama_lengkap],
                                ['Email', $peserta->user->email],
                                ['No HP', $peserta->no_hp],
                                ['Tempat Lahir', $peserta->tempat_lahir],
                                ['Tanggal Lahir', $peserta->tanggal_lahir ? $peserta->tanggal_lahir->format('d/m/Y') : null],
                                ['Jenis Kelamin', $peserta->jenis_kelamin == 'L' ? 'Laki-laki' : ($peserta->jenis_kelamin == 'P' ? 'Perempuan' : null)],
                                ['Agama', $peserta->agama],
                                ['Alamat', $peserta->alamat],
                            ];
                        @endphp
                        @foreach($fields as [$label, $value])
                            <div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">{{ $label }}</dt>
                                <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 dark:text-white">{{ $value ?? '-' }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </div>
            </x-card>

            <div class="space-y-6">
                @if($peserta->orangTua)
                    <x-card>
                        <div class="px-5 py-4 border-b border-gray-100 dark:border-slate-700">
                            <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Data Orang Tua</h3>
                        </div>
                        <div class="p-5">
                            <dl class="space-y-4">
                                @foreach([
                                    ['Nama Ayah', $peserta->orangTua->nama_ayah],
                                    ['Pekerjaan Ayah', $peserta->orangTua->pekerjaan_ayah],
                                    ['Nama Ibu', $peserta->orangTua->nama_ibu],
                                    ['Pekerjaan Ibu', $peserta->orangTua->pekerjaan_ibu],
                                    ['No HP', $peserta->orangTua->no_hp],
                                    ['Alamat', $peserta->orangTua->alamat],
                                ] as [$label, $value])
                                    <div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4">
                                        <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">{{ $label }}</dt>
                                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 dark:text-white">{{ $value ?? '-' }}</dd>
                                    </div>
                                @endforeach
                            </dl>
                        </div>
                    </x-card>
                @endif

                @if($peserta->sekolahAsal)
                    <x-card>
                        <div class="px-5 py-4 border-b border-gray-100 dark:border-slate-700">
                            <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Data Sekolah Asal</h3>
                        </div>
                        <div class="p-5">
                            <dl class="space-y-4">
                                @foreach([
                                    ['Nama Sekolah', $peserta->sekolahAsal->nama_sekolah],
                                    ['Alamat', $peserta->sekolahAsal->alamat],
                                    ['Tahun Lulus', $peserta->sekolahAsal->tahun_lulus],
                                ] as [$label, $value])
                                    <div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4">
                                        <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">{{ $label }}</dt>
                                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 dark:text-white">{{ $value ?? '-' }}</dd>
                                    </div>
                                @endforeach
                            </dl>
                        </div>
                    </x-card>
                @endif

                @if($peserta->pendaftaran)
                    <x-card>
                        <div class="px-5 py-4 border-b border-gray-100 dark:border-slate-700">
                            <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Data Pendaftaran</h3>
                        </div>
                        <div class="p-5">
                            <dl class="space-y-4">
                                <div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Nomor Pendaftaran</dt>
                                    <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 dark:text-white">{{ $peserta->pendaftaran->nomor_pendaftaran ?? '-' }}</dd>
                                </div>
                                <div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Jalur</dt>
                                    <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 dark:text-white">{{ $peserta->pendaftaran->jalurPendaftaran->nama ?? '-' }}</dd>
                                </div>
                                <div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Status</dt>
                                    <dd class="mt-1 sm:mt-0 sm:col-span-2">
                                        @php
                                            $statusColors = ['draft'=>'gray','submitted'=>'yellow','verifikasi'=>'blue','diterima'=>'green','cadangan'=>'yellow','ditolak'=>'red'];
                                            $color = $statusColors[$peserta->pendaftaran->status_pendaftaran] ?? 'gray';
                                        @endphp
                                        <x-badge :color="$color">{{ ucfirst($peserta->pendaftaran->status_pendaftaran) }}</x-badge>
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </x-card>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
