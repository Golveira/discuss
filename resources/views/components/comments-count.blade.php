@props(['count' => 0])

<div class="flex items-center gap-2">
    <x-icons.comment class="h-5 w-5 text-gray-500 dark:text-gray-400" />
    <span class="text-sm text-gray-500 dark:text-gray-400">
        {{ $count }}
    </span>
</div>
