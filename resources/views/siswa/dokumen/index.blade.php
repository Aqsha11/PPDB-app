<x-app-layout>
    <x-slot name="header">Dokumen Persyaratan</x-slot>

    <div class="space-y-6">
        @if($errors->any())
            <div class="p-4 bg-red-50 border border-red-200 rounded-lg">
                <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(!$pendaftaran)
            <x-card>
                <div class="text-center py-6">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <p class="mt-4 text-gray-600 font-medium">Belum memilih jalur pendaftaran</p>
                    <p class="text-sm text-gray-500 mt-1">Silakan pilih jalur pendaftaran terlebih dahulu sebelum mengunggah dokumen.</p>
                    <a href="{{ route('siswa.jalur.index') }}" class="mt-4 inline-block text-sm text-blue-600 hover:underline">Pilih Jalur &rarr;</a>
                </div>
            </x-card>
        @else
            <x-card title="Daftar Dokumen Persyaratan">
                <div class="divide-y divide-gray-100">
                    @forelse($persyaratan as $item)
                        @php
                            $uploaded = $dokumen?->firstWhere('persyaratan_dokumen_id', $item->id);
                        @endphp
                        <div class="py-4 first:pt-0 last:pb-0">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2">
                                        <p class="text-sm font-medium text-gray-900">{{ $item->nama }}</p>
                                        @if($item->is_required)
                                            <x-badge color="red">Wajib</x-badge>
                                        @else
                                            <x-badge color="gray">Opsional</x-badge>
                                        @endif
                                    </div>
                                    @if($item->keterangan)
                                        <p class="text-xs text-gray-500 mt-0.5">{{ $item->keterangan }}</p>
                                    @endif

                                    @if($uploaded)
                                        <div class="mt-2 flex items-center gap-2">
                                            <svg class="h-4 w-4 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <span class="text-sm text-gray-700 truncate">{{ basename($uploaded->file_path) }}</span>
                                            @if($uploaded->status_verifikasi === 'verified')
                                                <x-badge color="green">Terverifikasi</x-badge>
                                            @elseif($uploaded->status_verifikasi === 'ditolak')
                                                <x-badge color="red">Ditolak</x-badge>
                                            @else
                                                <x-badge color="yellow">Menunggu</x-badge>
                                            @endif
                                        </div>
                                    @endif
                                </div>

                                <div class="shrink-0">
                                    @if($uploaded)
                                        <form method="POST" action="{{ route('siswa.dokumen.destroy', $uploaded) }}" onsubmit="return confirm('Hapus dokumen ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button type="submit" class="!px-2 !py-1 text-xs">Hapus</x-danger-button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('siswa.dokumen.store') }}" enctype="multipart/form-data" class="flex flex-col items-end gap-1">
                                            @csrf
                                            <input type="hidden" name="persyaratan_dokumen_id" value="{{ $item->id }}">
                                            <input type="file" name="file" accept=".pdf,.jpg,.jpeg,.png" class="block w-full text-xs text-gray-500 file:mr-2 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-medium file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100" required>
                                            <x-input-error :messages="$errors->get('file')" class="mt-1" />
                                            <x-primary-button type="submit" class="!px-3 !py-1 text-xs mt-1">Upload</x-primary-button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-6">
                            <p class="text-sm text-gray-500">Tidak ada persyaratan dokumen untuk jalur ini.</p>
                        </div>
                    @endforelse
                </div>
            </x-card>

            @if($pendaftaran->status === 'draft')
                <x-card>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-medium text-gray-900">Finalisasi Pendaftaran</p>
                            <p class="text-sm text-gray-500">Pastikan semua data dan dokumen sudah lengkap sebelum mengirimkan pendaftaran.</p>
                        </div>
                        <form method="POST" action="{{ route('siswa.pendaftaran.submit') }}" onsubmit="return confirm('Yakin akan mengirimkan pendaftaran? Data tidak dapat diubah setelah dikirim.')">
                            @csrf
                            <x-primary-button class="!bg-green-600 hover:!bg-green-500">Kirim Pendaftaran</x-primary-button>
                        </form>
                    </div>
                </x-card>
            @elseif(in_array($pendaftaran->status, ['submitted', 'verifikasi']))
                <x-card>
                    <div class="flex items-center gap-3 text-blue-700 bg-blue-50 p-4 rounded-lg">
                        <svg class="h-6 w-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-sm font-medium">Pendaftaran telah dikirim dan sedang dalam proses verifikasi.</p>
                    </div>
                </x-card>
            @endif
        @endif
    </div>
</x-app-layout>
