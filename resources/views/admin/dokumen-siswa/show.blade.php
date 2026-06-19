<x-app-layout>
    <x-slot name="header">Detail Dokumen Siswa</x-slot>

    <div class="mb-6 space-y-4">
        <x-breadcrumb :items="[
            ['label' => 'Home', 'url' => route('admin.dashboard')],
            ['label' => 'Dokumen Siswa', 'url' => route('admin.dokumen-siswa.index')],
            ['label' => 'Detail'],
        ]" />

        <a href="{{ route('admin.dokumen-siswa.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
            &larr; Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="space-y-6">
            <x-card title="Informasi Siswa">
                <dl class="divide-y divide-gray-100">
                    <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Nama Siswa</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900 font-semibold">{{ $dokumenSiswa->pendaftaran->siswa->user->name ?? $dokumenSiswa->pendaftaran->siswa->nama_lengkap ?? '-' }}</dd>
                    </div>
                    <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">NISN</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $dokumenSiswa->pendaftaran->siswa->nisn ?? '-' }}</dd>
                    </div>
                    <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Nomor Pendaftaran</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $dokumenSiswa->pendaftaran->nomor_pendaftaran ?? '-' }}</dd>
                    </div>
                </dl>
            </x-card>

            <x-card title="Informasi Dokumen">
                <dl class="divide-y divide-gray-100">
                    <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Nama Dokumen</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $dokumenSiswa->persyaratanDokumen->nama ?? '-' }}</dd>
                    </div>
                    <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Status Verifikasi</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2">
                            @if($dokumenSiswa->status === 'terverifikasi')
                                <x-badge color="green">Terverifikasi</x-badge>
                            @elseif($dokumenSiswa->status === 'ditolak')
                                <x-badge color="red">Ditolak</x-badge>
                            @else
                                <x-badge color="yellow">Pending</x-badge>
                            @endif
                        </dd>
                    </div>
                    @if($dokumenSiswa->verified_at)
                        <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">Tgl Verifikasi</dt>
                            <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $dokumenSiswa->verified_at->format('d/m/Y H:i') }}</dd>
                        </div>
                    @endif
                    <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Keterangan</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $dokumenSiswa->catatan ?? '-' }}</dd>
                    </div>
                </dl>
            </x-card>
        </div>

        <x-card title="File Dokumen">
            @if($dokumenSiswa->file)
                @php
                    $ext = strtolower(pathinfo($dokumenSiswa->file, PATHINFO_EXTENSION));
                    $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                @endphp
                @if($isImage)
                    <div class="mb-4">
                        <img src="{{ Storage::url($dokumenSiswa->file) }}" alt="Dokumen" class="w-full rounded-lg border border-gray-200">
                    </div>
                @else
                    <div class="mb-4 flex items-center justify-center p-8 bg-gray-50 rounded-lg border border-gray-200">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                @endif
                <a href="{{ Storage::url($dokumenSiswa->file) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                    Download / Lihat File
                </a>
            @else
                <p class="text-sm text-gray-500">File tidak tersedia.</p>
            @endif
        </x-card>
    </div>
</x-app-layout>
