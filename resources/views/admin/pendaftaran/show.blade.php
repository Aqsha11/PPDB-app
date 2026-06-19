<x-app-layout>
    <x-slot name="header">Detail Pendaftaran</x-slot>

    <x-breadcrumb :items="[['label'=>'Dashboard','url'=>route('admin.dashboard')],['label'=>'Pendaftaran','url'=>route('admin.pendaftaran.index')],['label'=>'Detail']]" />

    <div class="mt-6 space-y-6">
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.pendaftaran.index') }}"
                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                &larr; Kembali
            </a>
            @php
                $statusColor = match($pendaftaran->status_pendaftaran) {
                    'draft' => 'gray',
                    'submitted' => 'yellow',
                    'verifikasi' => 'blue',
                    'diterima' => 'green',
                    'ditolak' => 'red',
                    'cadangan' => 'yellow',
                    default => 'gray',
                };
            @endphp
            <x-badge :color="$statusColor">{{ ucfirst($pendaftaran->status_pendaftaran) }}</x-badge>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <x-card title="Informasi Pendaftaran">
                <dl class="divide-y divide-gray-100">
                    <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Kode Pendaftaran</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $pendaftaran->kode_pendaftaran ?? $pendaftaran->nomor_pendaftaran ?? '-' }}</dd>
                    </div>
                    <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Tanggal Daftar</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $pendaftaran->created_at ? $pendaftaran->created_at->format('d/m/Y H:i') : '-' }}</dd>
                    </div>
                    <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Jalur Pendaftaran</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $pendaftaran->jalurPendaftaran->nama ?? '-' }}</dd>
                    </div>
                    <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Kuota Jalur</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $pendaftaran->jalurPendaftaran->kuota ?? '-' }}</dd>
                    </div>
                    <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Periode</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $pendaftaran->periodePpdb->nama ?? '-' }}</dd>
                    </div>
                    <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Tanggal Mulai</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $pendaftaran->periodePpdb->tanggal_mulai ? $pendaftaran->periodePpdb->tanggal_mulai->format('d/m/Y') : '-' }}</dd>
                    </div>
                    <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Tanggal Selesai</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $pendaftaran->periodePpdb->tanggal_selesai ? $pendaftaran->periodePpdb->tanggal_selesai->format('d/m/Y') : '-' }}</dd>
                    </div>
                </dl>
            </x-card>

            <x-card title="Data Siswa">
                <dl class="divide-y divide-gray-100">
                    <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">NISN</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $pendaftaran->siswa->nisn ?? '-' }}</dd>
                    </div>
                    <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Nama Lengkap</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm font-semibold text-gray-900">{{ $pendaftaran->siswa->nama_lengkap ?? $pendaftaran->siswa->user->name ?? '-' }}</dd>
                    </div>
                    <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Email</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $pendaftaran->siswa->user->email ?? '-' }}</dd>
                    </div>
                    <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">No HP</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $pendaftaran->siswa->no_hp ?? '-' }}</dd>
                    </div>
                    <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Tempat Lahir</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $pendaftaran->siswa->tempat_lahir ?? '-' }}</dd>
                    </div>
                    <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Tanggal Lahir</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $pendaftaran->siswa->tanggal_lahir ? $pendaftaran->siswa->tanggal_lahir->format('d/m/Y') : '-' }}</dd>
                    </div>
                    <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Jenis Kelamin</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $pendaftaran->siswa->jenis_kelamin ?? '-' }}</dd>
                    </div>
                    <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $pendaftaran->siswa->alamat ?? '-' }}</dd>
                    </div>
                </dl>
            </x-card>
        </div>

        <x-card title="Dokumen Pendaftaran">
            @if($pendaftaran->dokumenPendaftarans && $pendaftaran->dokumenPendaftarans->count())
                <x-table :headers="['Nama Dokumen', 'File', 'Status Verifikasi']">
                    @foreach($pendaftaran->dokumenPendaftarans as $dok)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $dok->persyaratanDokumen->nama ?? $dok->nama_dokumen ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                @if($dok->file)
                                    <a href="{{ Storage::url($dok->file) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 underline font-medium">Lihat File</a>
                                @else
                                    <span class="text-gray-400">Belum upload</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($dok->verified_at)
                                    <x-badge color="green">Terverifikasi</x-badge>
                                @else
                                    <x-badge color="yellow">Belum Verifikasi</x-badge>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </x-table>
            @else
                <x-empty-state title="Belum ada dokumen" description="Siswa belum mengunggah dokumen persyaratan." />
            @endif
        </x-card>

        @if($pendaftaran->hasilSeleksi)
            <x-card title="Hasil Seleksi">
                <dl class="divide-y divide-gray-100">
                    <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Status</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2">
                            @php
                                $hasilColor = match($pendaftaran->hasilSeleksi->status) {
                                    'diterima' => 'green',
                                    'cadangan' => 'yellow',
                                    'ditolak' => 'red',
                                    default => 'gray',
                                };
                            @endphp
                            <x-badge :color="$hasilColor">{{ ucfirst($pendaftaran->hasilSeleksi->status) }}</x-badge>
                        </dd>
                    </div>
                    <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Nilai</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $pendaftaran->hasilSeleksi->nilai ?? '-' }}</dd>
                    </div>
                    <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Keterangan</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $pendaftaran->hasilSeleksi->keterangan ?? '-' }}</dd>
                    </div>
                </dl>
            </x-card>
        @endif
    </div>
</x-app-layout>
