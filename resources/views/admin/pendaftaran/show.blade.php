@php
    $statusColor = match($pendaftaran->status_pendaftaran) {
        'draft' => 'gray',
        'submitted' => 'blue',
        'verifikasi' => 'yellow',
        'diterima' => 'green',
        'cadangan' => 'yellow',
        'ditolak' => 'red',
        default => 'gray',
    };
@endphp

<x-app-layout>
    <div class="space-y-6">

        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'route' => 'admin.dashboard'],
            ['label' => 'Data Pendaftaran', 'route' => 'admin.pendaftaran.index'],
            ['label' => 'Detail Pendaftaran']
        ]" />

        <x-admin.module-header title="Detail Pendaftaran" description="Informasi lengkap pendaftaran peserta.">
            @slot('actions')
                <div class="flex items-center gap-2">
                    <x-badge :color="$statusColor">{{ ucfirst($pendaftaran->status_pendaftaran) }}</x-badge>
                    <x-icon-button href="{{ route('admin.pendaftaran.index') }}" variant="default" title="Kembali">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </x-icon-button>
                </div>
            @endslot
        </x-admin.module-header>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <x-card title="Biodata Peserta">
                <dl class="space-y-4">
                    <div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">NISN</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 dark:text-white">{{ $pendaftaran->peserta->nisn ?? '-' }}</dd>
                    </div>
                    <div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Nama Lengkap</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm font-semibold text-gray-900 dark:text-white">{{ $pendaftaran->peserta->nama_lengkap ?? $pendaftaran->peserta->user->name ?? '-' }}</dd>
                    </div>
                    <div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Email</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 dark:text-white">{{ $pendaftaran->peserta->user->email ?? '-' }}</dd>
                    </div>
                    <div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">No HP</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 dark:text-white">{{ $pendaftaran->peserta->no_hp ?? '-' }}</dd>
                    </div>
                    <div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Tempat Lahir</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 dark:text-white">{{ $pendaftaran->peserta->tempat_lahir ?? '-' }}</dd>
                    </div>
                    <div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Tanggal Lahir</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 dark:text-white">{{ $pendaftaran->peserta->tanggal_lahir ? $pendaftaran->peserta->tanggal_lahir->format('d/m/Y') : '-' }}</dd>
                    </div>
                    <div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Jenis Kelamin</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 dark:text-white">{{ $pendaftaran->peserta->jenis_kelamin ?? '-' }}</dd>
                    </div>
                    <div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Alamat</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 dark:text-white">{{ $pendaftaran->peserta->alamat ?? '-' }}</dd>
                    </div>
                </dl>
            </x-card>

            <x-card title="Orang Tua / Wali">
                @php $ot = $pendaftaran->peserta->orangTua; @endphp
                <dl class="space-y-4">
                    <div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Nama Ayah</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 dark:text-white">{{ $ot->nama_ayah ?? '-' }}</dd>
                    </div>
                    <div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">NIK Ayah</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 dark:text-white">{{ $ot->nik_ayah ?? '-' }}</dd>
                    </div>
                    <div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Pekerjaan Ayah</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 dark:text-white">{{ $ot->pekerjaan_ayah ?? '-' }}</dd>
                    </div>
                    <div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Nama Ibu</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 dark:text-white">{{ $ot->nama_ibu ?? '-' }}</dd>
                    </div>
                    <div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">NIK Ibu</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 dark:text-white">{{ $ot->nik_ibu ?? '-' }}</dd>
                    </div>
                    <div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Pekerjaan Ibu</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 dark:text-white">{{ $ot->pekerjaan_ibu ?? '-' }}</dd>
                    </div>
                    <div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Penghasilan</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 dark:text-white">{{ $ot->penghasilan ? 'Rp ' . number_format($ot->penghasilan, 0, ',', '.') : '-' }}</dd>
                    </div>
                    <div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">No HP Orang Tua</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 dark:text-white">{{ $ot->no_hp ?? '-' }}</dd>
                    </div>
                </dl>
            </x-card>

        </div>

        <x-card title="Sekolah Asal">
            @php $sa = $pendaftaran->peserta->sekolahAsal; @endphp
            <dl class="space-y-4">
                <div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Nama Sekolah</dt>
                    <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 dark:text-white">{{ $sa->nama_sekolah ?? '-' }}</dd>
                </div>
                <div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">NPSN</dt>
                    <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 dark:text-white">{{ $sa->npsn ?? '-' }}</dd>
                </div>
                <div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Alamat Sekolah</dt>
                    <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 dark:text-white">{{ $sa->alamat ?? '-' }}</dd>
                </div>
                <div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Tahun Lulus</dt>
                    <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 dark:text-white">{{ $sa->tahun_lulus ?? '-' }}</dd>
                </div>
            </dl>
        </x-card>

        <x-card title="Jalur Pendaftaran">
            <dl class="space-y-4">
                <div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Kode Pendaftaran</dt>
                    <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 dark:text-white">{{ $pendaftaran->kode_pendaftaran ?? $pendaftaran->nomor_pendaftaran ?? '-' }}</dd>
                </div>
                <div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Jalur</dt>
                    <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 dark:text-white">{{ $pendaftaran->jalurPendaftaran->nama ?? '-' }}</dd>
                </div>
                <div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Kuota Jalur</dt>
                    <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 dark:text-white">{{ $pendaftaran->jalurPendaftaran->kuota ?? '-' }}</dd>
                </div>
                <div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Periode</dt>
                    <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 dark:text-white">{{ $pendaftaran->periodePpdb->nama ?? '-' }}</dd>
                </div>
                <div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Tanggal Daftar</dt>
                    <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 dark:text-white">{{ $pendaftaran->created_at ? $pendaftaran->created_at->format('d/m/Y H:i') : '-' }}</dd>
                </div>
            </dl>
        </x-card>

        <x-card title="Dokumen Pendaftaran">
            @if($pendaftaran->dokumenPendaftarans && $pendaftaran->dokumenPendaftarans->count())
                <x-table :headers="['Nama Dokumen', 'File', 'Status Verifikasi']">
                    @foreach($pendaftaran->dokumenPendaftarans as $dok)
                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                            <td class="px-5 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $dok->persyaratanDokumen->nama ?? $dok->nama_dokumen ?? '-' }}</td>
                            <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-slate-400">
                                @if($dok->file)
                                    <a href="{{ Storage::url($dok->file) }}" target="_blank" class="inline-flex items-center gap-1.5 theme-text hover:opacity-80 font-medium text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Lihat
                                    </a>
                                @else
                                    <span class="text-gray-400 dark:text-slate-500">Belum upload</span>
                                @endif
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap">
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
                <x-empty-state title="Belum ada dokumen" description="Peserta belum mengunggah dokumen persyaratan." />
            @endif
        </x-card>

        @if($pendaftaran->hasilSeleksi)
            <x-card title="Hasil Seleksi">
                <dl class="space-y-4">
                    <div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Status</dt>
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
                    <div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Nilai</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 dark:text-white">{{ $pendaftaran->hasilSeleksi->nilai ?? '-' }}</dd>
                    </div>
                    <div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Keterangan</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 dark:text-white">{{ $pendaftaran->hasilSeleksi->keterangan ?? '-' }}</dd>
                    </div>
                </dl>
            </x-card>
        @endif

        {{-- Aksi Verifikasi --}}
        @if(in_array($pendaftaran->status_pendaftaran, ['draft', 'submitted']))
            <x-card>
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="flex items-start gap-4">
                        <div class="w-11 h-11 rounded-xl bg-blue-50 dark:bg-blue-500/10 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900 dark:text-white">Verifikasi Pendaftaran</p>
                            <p class="text-sm text-gray-500 dark:text-slate-400 mt-0.5">
                                @if($pendaftaran->status_pendaftaran === 'draft')
                                    Peserta belum mengirim pendaftaran. Anda bisa langsung verifikasi dari sini.
                                @else
                                    Periksa semua data dan dokumen, lalu putuskan verifikasi atau tolak.
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 shrink-0">
                        @if($pendaftaran->status_pendaftaran === 'draft')
                            <form action="{{ route('admin.pendaftaran.destroy', $pendaftaran->id) }}" method="POST" onsubmit="return confirm('Hapus pendaftaran ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-gray-100 dark:bg-slate-700 text-gray-600 dark:text-slate-300 hover:bg-gray-200 dark:hover:bg-slate-600 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Hapus
                                </button>
                            </form>
                        @endif
                        <form action="{{ route('admin.verifikasi.update', $pendaftaran->id) }}" method="POST" onsubmit="return confirm('Tolak pendaftaran ini? Semua dokumen akan ditolak.')">
                            @csrf @method('PUT')
                            <input type="hidden" name="status" value="ditolak">
                            <input type="hidden" name="catatan" value="">
                            <button type="submit" class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-500/20 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                Tolak
                            </button>
                        </form>
                        <form action="{{ route('admin.verifikasi.update', $pendaftaran->id) }}" method="POST" onsubmit="return confirm('Verifikasi pendaftaran ini?')">
                            @csrf @method('PUT')
                            <input type="hidden" name="status" value="terverifikasi">
                            <input type="hidden" name="catatan" value="">
                            <button type="submit" class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 transition-colors shadow-lg shadow-emerald-500/25">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Verifikasi
                            </button>
                        </form>
                    </div>
                </div>
            </x-card>
        @elseif($pendaftaran->status_pendaftaran === 'verifikasi')
            <x-alert type="success" message="Pendaftaran ini sudah terverifikasi." />
        @elseif($pendaftaran->status_pendaftaran === 'ditolak')
            <x-alert type="danger" message="Pendaftaran ini ditolak." />
        @endif

    </div>
</x-app-layout>
