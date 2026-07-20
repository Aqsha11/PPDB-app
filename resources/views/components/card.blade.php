@props(['title' => null, 'subtitle' => null, 'footer' => null, 'padding' => true])

<div {{ $attributes->merge(['class' => 'bg-white dark:bg-slate-900 rounded-2xl border border-gray-200/60 dark:border-slate-800 overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300']) }}>
    @if($title)
        <div class="px-5 sm:px-6 py-4 border-b border-gray-100 dark:border-slate-800 bg-gray-50/50 dark:bg-slate-800/50">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-bold text-gray-900 dark:text-white">{{ $title }}</h3>
                    @if($subtitle)
                        <p class="mt-0.5 text-xs text-gray-500 dark:text-slate-400">{{ $subtitle }}</p>
                    @endif
                </div>
            </div>
        </div>
    @endif
    <div @if($padding) class="p-5 sm:p-6" @endif>
        {{ $slot }}
    </div>
    @if($footer)
        <div class="px-5 sm:px-6 py-3 border-t border-gray-100 dark:border-slate-800 bg-gray-50/50 dark:bg-slate-800/50 rounded-b-2xl">
            {{ $footer }}
        </div>
    @endif
</div>
