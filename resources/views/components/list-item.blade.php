<div class="flex gap-3 border-b border-gray-200 p-4 last:border-b-0 dark:border-gray-700">
    {{ $avatar ?? null }}

    <div class="flex flex-1 flex-col justify-between gap-4 lg:flex-row lg:items-center">
        <div class="font-medium dark:text-white">
            {{ $value }}

            <div class="flex flex-wrap items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                {{ $subvalue ?? null }}
            </div>
        </div>

        <div class="flex gap-3">
            {{ $actions ?? null }}
        </div>
    </div>
</div>
