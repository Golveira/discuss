@props(['value'])

<a {{ $attributes->merge(['class' => 'font-medium text-gray-900 dark:hover:text-blue-500 hover:underline dark:text-white']) }}
    wire:navigate>
    {{ $value ?? $slot }}
</a>
