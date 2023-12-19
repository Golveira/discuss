@props(['initials'])

<div
    {{ $attributes->merge(['class' => 'relative inline-flex h-10 w-10 items-center justify-center overflow-hidden rounded-full bg-gray-100 dark:bg-gray-600']) }}>
    <span class="font-medium text-gray-600 dark:text-gray-300">
        {{ $initials }}
    </span>
</div>
