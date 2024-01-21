<button
    {{ $attributes->merge(['class' => 'inline-flex items-center gap-1 rounded-full border border-gray-300 bg-white px-2 py-1 text-xs text-gray-500 transition-all hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-900 dark:hover:border-gray-600 dark:text-gray-400 dark:hover:bg-gray-800']) }}>
    {{ $slot }}
</button>
