@props(['name', 'label', 'icon'])

<li class="me-2">
    <a class="group inline-flex items-center justify-center gap-1 rounded-t-lg p-4 hover:border-gray-300 hover:text-gray-600 dark:hover:text-gray-300"
        href="#" @click="selected = '{{ $name }}'"
        :class="{ 'border-b-2 border-gray-300 text-gray-600 dark:text-gray-300': selected === '{{ $name }}' }">

        @if ($icon)
            <x-dynamic-component class="group-hover:text-gray-500 dark:group-hover:text-gray-300"
                component="icons.{{ $icon }}" />
        @endif

        {{ $label }}
    </a>
</li>

<div wire:key="{{ $name }}">
    <template x-teleport="#tab-container">
        <div x-show="selected === '{{ $name }}'">
            {{ $slot }}
        </div>
    </template>
</div>
