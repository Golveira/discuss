@props(['value'])

<a {{ $attributes->merge(['class' => 'font-medium text-gray-900 hover:underline dark:text-white']) }}>
    {{ $value ?? $slot }}
</a>
