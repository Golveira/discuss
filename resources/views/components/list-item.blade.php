<div class="flex items-center justify-between gap-3 border-b border-gray-200 p-4 last:border-b-0 dark:border-gray-700">
    <div class="flex items-center gap-4 overflow-hidden truncate">
        {{ $avatar }}

        <div class="font-medium dark:text-white">
            {{ $value }}

            {{ $subvalue ?? null }}
        </div>
    </div>

    {{ $actions ?? null }}
</div>
