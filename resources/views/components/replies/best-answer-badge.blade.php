@props(['value'])

<div class="rounded-full border border-green-700 px-2 py-1 dark:bg-green-900 dark:bg-opacity-30">
    <span class="flex items-center text-sm text-green-700 dark:text-green-500">
        <x-icons.check-circle class="mr-1 h-4 w-4" />
        <span>{{ $value }}</span>
    </span>
</div>
