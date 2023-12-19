@props(['avatar', 'link', 'value'])

<div
    class="flex flex-col gap-3 border-b border-gray-200 p-4 last:border-b-0 dark:border-gray-700 lg:flex-row lg:items-center lg:justify-between">
    <div class="flex items-center gap-4 overflow-hidden truncate">
        @if ($avatar)
            <div class="">
                <x-avatar-initials :initials="$avatar" />
            </div>
        @endif

        <div class="font-medium dark:text-white">
            <a class="font-medium text-gray-900 hover:underline dark:text-white" href="{{ $link }}" wire:navigate>
                {{ $value }}
            </a>

            {{ $subValue ?? null }}
        </div>
    </div>

    {{ $actions ?? null }}
</div>
