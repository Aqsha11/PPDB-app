@php
    $user = auth()->user();
    $peserta = $user->peserta;
    $pendaftaran = $peserta ? $peserta->pendaftaran()->first() : null;

    $stepDone1 = $peserta && $peserta->nama_lengkap && $peserta->pas_foto;
    $stepDone2 = $stepDone1 && $peserta->orangTua && $peserta->orangTua->nama_ayah;
    $stepDone3 = $stepDone2 && $peserta->sekolahAsal && $peserta->sekolahAsal->nama_sekolah;
    $stepDone4 = $stepDone3 && $pendaftaran && $pendaftaran->jalur_pendaftaran_id;

    $requiredCount = 0;
    $uploadedRequiredCount = 0;
    if ($pendaftaran && $pendaftaran->jalur_pendaftaran_id) {
        $requiredCount = \App\Models\PersyaratanDokumen::where('jalur_pendaftaran_id', $pendaftaran->jalur_pendaftaran_id)->where('is_wajib', true)->count();
        if ($requiredCount > 0) {
            $wajibIds = \App\Models\PersyaratanDokumen::where('jalur_pendaftaran_id', $pendaftaran->jalur_pendaftaran_id)->where('is_wajib', true)->pluck('id');
            $uploadedRequiredCount = $pendaftaran->dokumenPendaftarans()->whereIn('persyaratan_dokumen_id', $wajibIds)->count();
        }
    }
    $stepDone5 = $requiredCount > 0 ? $uploadedRequiredCount >= $requiredCount : ($pendaftaran && $pendaftaran->dokumenPendaftarans()->count() > 0);
    $stepDone6 = $stepDone5 && $pendaftaran && $pendaftaran->status_pendaftaran !== 'draft';

    $registrationComplete = $stepDone6;

    $currentStep = 7;
    $steps = [1 => $stepDone1, 2 => $stepDone2, 3 => $stepDone3, 4 => $stepDone4, 5 => $stepDone5, 6 => $stepDone6];
    foreach ($steps as $si => $sd) {
        if (!$sd) { $currentStep = $si; break; }
    }

    $stepLabels = [1 => 'Biodata Diri', 2 => 'Data Orang Tua', 3 => 'Sekolah Asal', 4 => 'Pilih Jalur', 5 => 'Upload Dokumen', 6 => 'Submit'];
    $stepIcons = [
        1 => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>',
        2 => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>',
        3 => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>',
        4 => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>',
        5 => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>',
        6 => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>',
    ];
    $stepRoutes = [1 => 'peserta.biodata.edit', 2 => 'peserta.orang-tua.edit', 3 => 'peserta.sekolah-asal.edit', 4 => 'peserta.jalur.index', 5 => 'peserta.dokumen.index', 6 => 'peserta.dokumen.index'];

    if ($registrationComplete) {
        $items = [
            ['label' => 'Dashboard', 'route' => 'peserta.dashboard', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />'],
            ['label' => 'Pendaftaran', 'route' => 'peserta.pendaftaran.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />'],
            ['label' => 'Pengumuman', 'route' => 'peserta.pengumuman.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>'],
            ['label' => 'Daftar Ulang', 'route' => 'peserta.daftar-ulang.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>'],
            ['label' => 'Profil', 'route' => 'peserta.profil.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />'],
        ];
    } else {
        $items = [
            ['label' => 'Dashboard', 'route' => 'peserta.dashboard', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />'],
        ];
        for ($i = 1; $i <= 6; $i++) {
            $items[] = ['label' => $stepLabels[$i], 'route' => $stepRoutes[$i], 'icon' => $stepIcons[$i], 'step' => $i, 'done' => $steps[$i], 'active' => $currentStep === $i];
        }
    }
@endphp

<aside class="fixed inset-y-0 left-0 z-[70] w-[272px] bg-white dark:bg-slate-900 border-r border-gray-200/60 dark:border-slate-800 flex flex-col overflow-hidden transition-all duration-300 ease-in-out"
       :style="desktop ? 'transform: translateX(0)' : (mobileOpen ? 'transform: translateX(0)' : 'transform: translateX(-100%)')">

    <div class="flex items-center justify-between h-16 px-5 border-b border-gray-200/60 dark:border-slate-800 shrink-0">
        <a href="{{ route('peserta.dashboard') }}" class="flex items-center space-x-3 group">
            @if(isset($profil) && $profil?->logo)
                <img src="{{ Storage::url($profil->logo) }}" alt="{{ $profil->nama_sekolah }}" class="h-9 w-auto shrink-0 transition-transform group-hover:scale-105">
            @else
                <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 transition-transform group-hover:scale-105 theme-bg">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
            @endif
            <div class="min-w-0">
                <span class="text-base font-bold text-gray-900 dark:text-white block truncate">{{ $profil->nama_sekolah ?? config('app.name', 'PPDB') }}</span>
                <p class="text-[10px] font-semibold theme-text uppercase tracking-widest">Peserta</p>
            </div>
        </a>
        <button @click="closeMobile()" class="lg:hidden text-gray-400 hover:text-gray-600 transition-colors p-2 rounded-xl hover:bg-gray-100 dark:hover:bg-slate-800">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    @if(!$registrationComplete)
        <div class="mx-4 mt-4 px-4 py-3 rounded-xl border theme-border theme-bg-light">
            <div class="flex items-center justify-between mb-1">
                <p class="text-xs font-bold theme-text">Tahap {{ min($currentStep, 6) }}/6</p>
                <span class="text-[10px] font-bold theme-text bg-white dark:bg-slate-800 px-2 py-0.5 rounded-full">{{ round((min($currentStep, 6) / 6) * 100) }}%</span>
            </div>
            <p class="text-[11px] text-gray-500 dark:text-slate-400 mb-2">Lengkapi pendaftaran Anda</p>
            <div class="h-1.5 bg-gray-200 dark:bg-slate-700 rounded-full overflow-hidden">
                <div class="h-full rounded-full transition-all duration-700 ease-out theme-bg" style="width: {{ (min($currentStep, 6) / 6) * 100 }}%"></div>
            </div>
        </div>
    @endif

    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1 scrollbar-thin">
        @foreach($items as $item)
            @php
                $isActive = request()->routeIs($item['route']);
                $isStep = isset($item['step']);
                $isDone = $item['done'] ?? false;
                $isHighlight = $item['active'] ?? false;
            @endphp
            <a href="{{ route($item['route']) }}" @click="closeMobile()"
               class="group relative flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200
               {{ $isActive
                   ? ($isHighlight ? 'text-white shadow-lg' : 'theme-bg-light theme-text')
                   : ($isHighlight ? 'theme-bg-light theme-text hover:opacity-80' : 'text-gray-600 dark:text-slate-400 hover:bg-gray-100 dark:hover:bg-slate-800 hover:text-gray-900 dark:hover:text-white')
               }}"
               @if($isActive && !$isHighlight) style="background-color: color-mix(in srgb, var(--color-primary) 10%, transparent)" @endif
               @if($isActive && $isHighlight) style="background-color: var(--color-primary)" @endif>
                @if($isActive && !$isHighlight)
                    <span class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 rounded-r-full theme-bg"></span>
                @endif
                @if($isStep)
                    <span class="w-5 h-5 shrink-0 mr-3 rounded-full flex items-center justify-center text-[10px] font-bold
                        {{ $isDone
                            ? 'bg-emerald-100 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400'
                            : ($isHighlight
                                ? 'bg-white/20 text-white'
                                : 'bg-gray-200 dark:bg-slate-700 text-gray-500 dark:text-slate-400')
                        }}">
                        @if($isDone)
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        @else
                            {{ $item['step'] }}
                        @endif
                    </span>
                @else
                    <svg class="w-5 h-5 shrink-0 mr-3 transition-colors {{ $isActive ? ($isHighlight ? 'text-white' : 'theme-text') : 'text-gray-400 dark:text-slate-500 group-hover:text-gray-600 dark:group-hover:text-slate-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        {!! $item['icon'] !!}
                    </svg>
                @endif
                <span class="truncate">{{ $item['label'] }}</span>
                @if($isActive)
                    <span class="ml-auto w-1.5 h-1.5 rounded-full {{ $isHighlight ? 'bg-white' : 'theme-bg' }} shrink-0"></span>
                @endif
            </a>
        @endforeach
    </nav>

    <div class="shrink-0 border-t border-gray-200/60 dark:border-slate-800 p-3">
        <div class="flex items-center space-x-3 p-2 rounded-xl hover:bg-gray-100 dark:hover:bg-slate-800 transition-colors">
            @if(auth()->user()->peserta?->pas_foto)
                <img src="{{ Storage::url(auth()->user()->peserta->pas_foto) }}" alt="{{ auth()->user()->name }}" class="w-9 h-9 rounded-xl object-cover shrink-0 shadow-sm">
            @else
                <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 theme-bg">
                    <span class="text-white font-bold text-sm">{{ substr(auth()->user()->name, 0, 1) }}</span>
                </div>
            @endif
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">{{ auth()->user()->name }}</p>
                <p class="text-[10px] font-medium text-gray-400 dark:text-slate-500 uppercase tracking-wider">Peserta</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-gray-400 hover:text-red-500 dark:hover:text-red-400 transition-colors p-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-500/10" title="Keluar">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</aside>
