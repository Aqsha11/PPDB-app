<div {{ $attributes->merge(['class' => 'rounded-2xl p-6 sm:p-8 text-white relative overflow-hidden theme-bg']) }}>
    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-16 translate-x-16 blur-2xl"></div>
    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-12 -translate-x-12 blur-xl"></div>
    <div class="relative flex items-start gap-4">
        <div class="w-14 h-14 rounded-2xl flex items-center justify-center shrink-0 bg-white/15 backdrop-blur-sm border border-white/10">
            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
        </div>
        <div class="flex-1">
            <h2 class="text-xl font-bold text-white">Selamat Datang, {{ $name ?? auth()->user()->name }}!</h2>
            <p class="mt-1 text-sm text-white/75">Kelola pendaftaran PPDB Anda di sini.</p>
        </div>
    </div>
</div>
