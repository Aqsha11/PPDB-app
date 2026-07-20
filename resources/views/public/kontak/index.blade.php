<x-layouts.public title="Kontak">
    <div class="relative overflow-hidden" style="background-color: var(--warna-primary)">
        <div class="absolute inset-0 opacity-10"><div class="absolute -top-20 -right-20 w-72 h-72 bg-white rounded-full blur-3xl"></div><div class="absolute -bottom-20 -left-20 w-72 h-72 bg-white rounded-full blur-3xl"></div></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight">Hubungi Kami</h1>
            <p class="text-white/70 mt-3 text-lg">Silakan hubungi kami melalui form atau informasi kontak di bawah</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-16">
        <div class="grid lg:grid-cols-5 gap-12">
            {{-- Form --}}
            <div class="lg:col-span-3">
                <div class="bg-white dark:bg-slate-900 rounded-3xl border border-gray-200/80 dark:border-slate-800 p-5 sm:p-8 shadow-lg shadow-black/[0.04] dark:shadow-black/20">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Kirim Pesan</h2>
                    <p class="text-gray-500 dark:text-slate-400 text-sm mb-8">Isi form berikut dan kami akan merespons segera</p>
                    <form method="POST" action="{{ route('public.kontak.store') }}">
                        @csrf
                        <div class="space-y-5">
                            <div class="grid sm:grid-cols-2 gap-5">
                                <div>
                                    <label for="nama" class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-2">Nama Lengkap <span class="text-red-400">*</span></label>
                                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" class="w-full rounded-xl border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 focus:border-[var(--warna-primary)] focus:ring-[var(--warna-primary)] focus:bg-white dark:focus:bg-slate-700 transition-colors" required>
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-2">Email <span class="text-red-400">*</span></label>
                                    <input type="email" id="email" name="email" placeholder="nama@email.com" class="w-full rounded-xl border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 focus:border-[var(--warna-primary)] focus:ring-[var(--warna-primary)] focus:bg-white dark:focus:bg-slate-700 transition-colors" required>
                                </div>
                            </div>
                            <div>
                                    <label for="telepon" class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-2">Telepon (opsional)</label>
                                    <input type="text" id="telepon" name="telepon" placeholder="Contoh: 081234567890" class="w-full rounded-xl border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 focus:border-[var(--warna-primary)] focus:ring-[var(--warna-primary)] focus:bg-white dark:focus:bg-slate-700 transition-colors">
                            </div>
                            <div>
                                <label for="pesan" class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-2">Pesan <span class="text-red-400">*</span></label>
                                <textarea id="pesan" name="pesan" rows="5" placeholder="Tuliskan pesan Anda di sini..." class="w-full rounded-xl border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 focus:border-[var(--warna-primary)] focus:ring-[var(--warna-primary)] focus:bg-white dark:focus:bg-slate-700 transition-colors resize-none" required></textarea>
                            </div>
                            <button type="submit" class="w-full py-3.5 text-white font-semibold rounded-2xl transition-all duration-200 hover:shadow-lg hover:shadow-black/10 hover:-translate-y-0.5 btn-theme">
                                Kirim Pesan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Info --}}
            <div class="lg:col-span-2 space-y-6">
                @if($profil)
                    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-gray-200/80 dark:border-slate-800 p-5 sm:p-8 space-y-6 shadow-lg shadow-black/[0.04] dark:shadow-black/20">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Informasi Kontak</h2>
                        @if($profil->alamat)
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-2xl flex items-center justify-center shrink-0 theme-bg-light">
                                    <svg class="h-5 w-5" style="color: var(--warna-primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 dark:text-white text-sm">Alamat</p>
                                    <p class="text-gray-500 dark:text-slate-400 text-sm mt-1 leading-relaxed">{{ $profil->alamat }}</p>
                                </div>
                            </div>
                        @endif
                        @if($profil->email)
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-2xl flex items-center justify-center shrink-0 theme-bg-light">
                                    <svg class="h-5 w-5" style="color: var(--warna-primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 dark:text-white text-sm">Email</p>
                                    <a href="mailto:{{ $profil->email }}" class="text-sm mt-1 hover:underline block" style="color: var(--warna-primary)">{{ $profil->email }}</a>
                                </div>
                            </div>
                        @endif
                        @if($profil->telepon)
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-2xl flex items-center justify-center shrink-0 theme-bg-light">
                                    <svg class="h-5 w-5" style="color: var(--warna-primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 dark:text-white text-sm">Telepon</p>
                                    <a href="tel:{{ $profil->telepon }}" class="text-sm mt-1 hover:underline block" style="color: var(--warna-primary)">{{ $profil->telepon }}</a>
                                </div>
                            </div>
                        @endif
                        @if($profil->whatsapp)
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-2xl flex items-center justify-center shrink-0 bg-green-50 dark:bg-green-500/10">
                                    <svg class="h-5 w-5 text-green-600" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 dark:text-white text-sm">WhatsApp</p>
                                    <a href="https://wa.me/{{ $profil->whatsapp }}" target="_blank" class="text-sm mt-1 hover:underline block" style="color: var(--warna-primary)">{{ $profil->whatsapp }}</a>
                                </div>
                            </div>
                        @endif
                        @if($profil->google_maps)
                            <div>
                                <p class="font-bold text-gray-900 dark:text-white text-sm mb-3">Lokasi</p>
                                <div class="rounded-2xl overflow-hidden border border-gray-200/80 dark:border-slate-800">
                                    @if(Str::contains($profil->google_maps, '<iframe'))
                                        {!! preg_replace('/width="[^"]*"/', 'width="100%"', preg_replace('/height="[^"]*"/', 'height="300"', $profil->google_maps)) !!}
                                    @else
                                        <iframe src="{{ $profil->google_maps }}" width="100%" height="300" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                @endif

                @if($mediaSosial->isNotEmpty())
                    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-gray-200/80 dark:border-slate-800 p-5 sm:p-8 shadow-lg shadow-black/[0.04] dark:shadow-black/20">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-5">Ikuti Kami</h2>
                        <div class="flex flex-wrap gap-3">
                            @foreach($mediaSosial as $item)
                                <a href="{{ $item->url }}" target="_blank" rel="noopener noreferrer" class="w-12 h-12 rounded-2xl flex items-center justify-center transition-all duration-200 hover:scale-110 hover:shadow-lg" style="background-color: color-mix(in srgb, var(--warna-primary) 8%, transparent)" title="{{ $item->platform }}">
                                    @if($item->icon)
                                        <i class="{!! $item->icon !!}" style="color: var(--warna-primary)"></i>
                                    @else
                                        <span class="text-xs font-bold" style="color: var(--warna-primary)">{{ substr($item->platform, 0, 2) }}</span>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.public>
