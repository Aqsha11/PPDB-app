@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-500 dark:text-red-400 space-y-1 mt-1.5']) }}>
        @foreach ((array) $messages as $message)
            <li class="flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/><text x="10" y="14" text-anchor="middle" fill="white" font-size="12" font-weight="bold">!</text></svg>
                {{ $message }}
            </li>
        @endforeach
    </ul>
@endif
