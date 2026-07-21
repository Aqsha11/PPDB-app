<x-app-layout>
    <x-slot name="header">Edit FAQ</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'FAQ', 'url' => route('admin.faq.index')],
            ['label' => 'Edit'],
        ]" />

        <x-admin.module-header title="Edit FAQ" description="Perbarui pertanyaan dan jawaban FAQ.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <form action="{{ route('admin.faq.update', $data->id) }}" method="POST" x-data="formValidation()">
                @csrf
                @method('PUT')

                <div class="space-y-5">
                    <div>
                        <x-input-label for="pertanyaan" value="* Pertanyaan" />
                        <x-text-input type="text" id="pertanyaan" name="pertanyaan" :value="old('pertanyaan', $data->pertanyaan)" class="mt-1" placeholder="Masukkan pertanyaan yang sering diajukan..." required maxlength="255" />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Pertanyaan yang sering diajukan oleh peserta/orang tua</p>
                        <x-input-error :messages="$errors->get('pertanyaan')" class="mt-1.5" />
                    </div>

                    <div>
                        <x-input-label for="jawaban" value="* Jawaban" />
                        <textarea id="jawaban" name="jawaban" rows="5" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm transition-colors" placeholder="Masukkan jawaban dari pertanyaan..." required>{{ old('jawaban', $data->jawaban) }}</textarea>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Jawaban lengkap untuk pertanyaan yang diajukan</p>
                        <x-input-error :messages="$errors->get('jawaban')" class="mt-1.5" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <x-input-label for="urutan" value="Urutan" />
                            <x-text-input type="number" id="urutan" name="urutan" :value="old('urutan', $data->urutan)" class="mt-1" min="0" placeholder="Masukkan urutan tampilan..." />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Urutan kemunculan FAQ (0 = pertama)</p>
                            <x-input-error :messages="$errors->get('urutan')" class="mt-1.5" />
                        </div>

                        <div>
                            <label class="inline-flex items-center gap-2 cursor-pointer mt-7">
                                <input type="checkbox" name="status" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" {{ old('status', $data->status) ? 'checked' : '' }}>
                                <span class="text-sm font-medium text-gray-700 dark:text-slate-300">Status Aktif</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100 dark:border-slate-700">
                    <x-secondary-button href="{{ route('admin.faq.index') }}">Batal</x-secondary-button>
                    <x-primary-button type="submit">Simpan</x-primary-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
