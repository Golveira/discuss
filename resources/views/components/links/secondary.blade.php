@props(['value'])

<a {{ $attributes->merge(['class' => 'text-sm font-medium text-gray-600 hover:underline dark:text-gray-400']) }}>
    {{ $value ?? $slot }}
</a>
