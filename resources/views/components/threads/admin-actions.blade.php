<ul class="space-y-1">
    @can('close', $thread)
        @if ($thread->isClosed())
            <li>
                <button class="text-sm text-gray-600 dark:text-gray-100" wire:click="openThread">
                    <div class="flex items-center gap-1 hover:text-blue-700 dark:hover:text-blue-500">
                        <x-icons.lock-open />
                        <span>Open thread</span>
                    </div>
                </button>
            </li>
        @else
            <li>
                <button class="text-sm text-gray-600 dark:text-gray-100" wire:click="closeThread">
                    <div class="flex items-center gap-1 hover:text-blue-700 dark:hover:text-blue-500">
                        <x-icons.lock-closed />
                        <span>Close thread</span>
                    </div>
                </button>
            </li>
        @endif
    @endcan

    @can('pin', $thread)
        @if ($thread->isPinned())
            <li>
                <button class="text-sm text-gray-600 dark:text-gray-100" wire:click="unpinThread">
                    <div class="flex items-center gap-1 hover:text-blue-700 dark:hover:text-blue-500">
                        <x-icons.pin />
                        <span>Unpin thread</span>
                    </div>
                </button>
            </li>
        @else
            <li>
                <button class="text-sm text-gray-600 dark:text-gray-100" wire:click="pinThread">
                    <div class="flex items-center gap-1 hover:text-blue-700 dark:hover:text-blue-500">
                        <x-icons.pin />
                        <span>Pin thread</span>
                    </div>
                </button>
            </li>
        @endif
    @endcan
</ul>
