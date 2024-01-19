@props(['value'])

<a {{ $attributes->merge(['class' => 'text-sm font-medium text-gray-600 hover:underline hover:text-blue-700 dark:hover:text-blue-500 dark:text-gray-400']) }}
    wire:navigate>
    {{ $value ?? $slot }}
</a>
