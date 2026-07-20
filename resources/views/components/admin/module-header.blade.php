@props(['title' => null, 'description' => null, 'subtitle' => null, 'icon' => null, 'actions' => null])

@php
    $desc = $description ?? $subtitle;
    $hasIcon = filled($icon);
    $hasActions = filled($actions);
@endphp

<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div class="flex items-start gap-3">
        @if($hasIcon)
            <div class="shrink-0 w-10 h-10 rounded-xl theme-bg-light flex items-center justify-center">
                <svg class="w-5 h-5 theme-text" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    {!! $icon !!}
                </svg>
            </div>
        @endif
        <div>
            @if($title)
                <h1 class="text-xl font-bold text-gray-900 dark:text-white">{{ $title }}</h1>
            @endif
            @if($desc)
                <p class="text-sm text-gray-500 dark:text-slate-400">{{ $desc }}</p>
            @endif
        </div>
    </div>
    @if($hasActions)
        <div class="shrink-0">
            {{ $actions }}
        </div>
    @endif
</div>
