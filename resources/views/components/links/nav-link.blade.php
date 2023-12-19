@props(['active'])

@php
    $classes = 'text-sm font-medium leading-5 text-gray-900 dark:text-white
transition duration-150 ease-in-out dark:hover:bg-gray-700 hover:bg-gray-100 p-3 rounded-lg';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
