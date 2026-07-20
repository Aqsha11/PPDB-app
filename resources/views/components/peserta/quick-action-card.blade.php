@props(['title' => 'Aksi Cepat'])

<div {{ $attributes->merge(['class' => 'bg-white dark:bg-slate-900 rounded-2xl border border-gray-200/60 dark:border-slate-800 overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300']) }}>
    @if($title)
        <div class="px-5 sm:px-6 py-4 border-b border-gray-100 dark:border-slate-800 bg-gray-50/50 dark:bg-slate-800/50">
            <h3 class="text-sm font-bold text-gray-900 dark:text-white">{{ $title }}</h3>
        </div>
    @endif
    <div class="p-5 sm:p-6">
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
            {{ $slot }}
        </div>
    </div>
</div>
