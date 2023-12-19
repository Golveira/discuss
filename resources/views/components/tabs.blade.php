@props(['selected'])

<div x-data="{ selected: '{{ $selected }}' }">
    <div class="border-b border-gray-200 dark:border-gray-700">
        <ul class="-mb-px flex flex-wrap text-center text-sm font-medium text-gray-500 dark:text-gray-400">
            {{ $slot }}
        </ul>
    </div>

    <div class="mt-6" id="tab-container">
    </div>
</div>
