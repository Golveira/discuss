@props(['value'])

<a {{ $attributes->merge(['class' => 'inline-flex items-center font-medium text-blue-600 hover:underline dark:text-blue-500']) }}
    wire:navigate>
    {{ $value ?? $slot }}
</a>
