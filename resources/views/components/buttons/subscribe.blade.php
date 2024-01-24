<button
    {{ $attributes->merge(['class' => 'flex w-full items-center justify-center gap-1 rounded-lg border border-gray-300 p-2 text-sm text-gray-600 hover:border-gray-400 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:border-gray-600']) }}>
    {{ $slot }}
</button>
