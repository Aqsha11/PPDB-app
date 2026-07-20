@props(['steps' => [], 'currentStep' => 1])

<div {{ $attributes }}>
    {{-- Desktop: horizontal --}}
    <div class="hidden md:block">
        <div class="relative">
            <div class="absolute top-5 left-0 right-0 h-0.5 bg-gray-200 dark:bg-slate-700">
                <div class="h-full rounded-full transition-all duration-700 ease-out theme-bg" style="width: {{ max(0, ($currentStep - 1) / count($steps) * 100) }}%"></div>
            </div>

            <div class="relative flex justify-between">
                @foreach($steps as $i => $step)
                    @php
                        $num = $i + 1;
                        $status = $num < $currentStep ? 'completed' : ($num === $currentStep ? 'current' : 'pending');
                    @endphp
                    <div class="flex flex-col items-center text-center" style="width: {{ 100 / count($steps) }}%">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold z-10 transition-all duration-300
                            {{ $status === 'completed' ? 'bg-emerald-500 text-white shadow-lg shadow-emerald-500/25' : ($status === 'current' ? 'text-white shadow-lg' : 'bg-gray-100 dark:bg-slate-800 text-gray-400 dark:text-slate-500 border-2 border-gray-200 dark:border-slate-700') }}"
                            @if($status === 'current') style="background-color: var(--color-primary); box-shadow: 0 4px 14px color-mix(in srgb, var(--color-primary) 30%, transparent)" @endif>
                            @if($status === 'completed')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                            @else
                                {{ $num }}
                            @endif
                        </div>
                        <p class="mt-2.5 text-xs font-medium leading-tight max-w-[80px] {{ $status === 'completed' ? 'text-emerald-600 dark:text-emerald-400' : ($status === 'current' ? 'font-bold text-gray-900 dark:text-white' : 'text-gray-400 dark:text-slate-500') }}">
                            {{ $step['label'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Mobile: vertical --}}
    <div class="md:hidden space-y-1">
        @foreach($steps as $i => $step)
            @php
                $num = $i + 1;
                $status = $num < $currentStep ? 'completed' : ($num === $currentStep ? 'current' : 'pending');
            @endphp
            <div class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 {{ $status === 'current' ? 'theme-bg-light border theme-border' : '' }}">
                <div class="shrink-0 w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold transition-all duration-200
                    {{ $status === 'completed' ? 'bg-emerald-500 text-white' : ($status === 'current' ? 'text-white' : 'bg-gray-100 dark:bg-slate-800 text-gray-400 dark:text-slate-500') }}"
                    @if($status === 'current') style="background-color: var(--color-primary)" @endif>
                    @if($status === 'completed')
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                    @else
                        {{ $num }}
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium {{ $status === 'completed' ? 'text-emerald-600 dark:text-emerald-400' : ($status === 'current' ? 'theme-text font-bold' : 'text-gray-400 dark:text-slate-500') }}">
                        {{ $step['label'] }}
                    </p>
                </div>
                @if($status === 'current' && !empty($step['route']))
                    <a href="{{ route($step['route']) }}" class="shrink-0 text-xs theme-text font-semibold hover:underline">Lanjutkan</a>
                @endif
            </div>
        @endforeach
    </div>
</div>
