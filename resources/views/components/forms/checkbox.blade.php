@props(['label'])

<div class="flex items-start">
    <input type="checkbox"
        {{ $attributes->merge(['class' => 'focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 h-4 w-4 rounded border border-gray-300 bg-gray-50 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800']) }}>

    @if ($label)
        <div class="ml-3 text-sm">
            <label class="text-gray-500 dark:text-gray-300" for="{{ $attributes->get('id') }}">
                {{ $label }}
            </label>
        </div>
    @endif
</div>
