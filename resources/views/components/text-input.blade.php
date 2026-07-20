@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)] rounded-lg shadow-sm text-sm transition-colors']) }}>
