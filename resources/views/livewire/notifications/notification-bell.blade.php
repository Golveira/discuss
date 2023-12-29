<div class="flex" wire:poll.15s>
    <x-buttons.transparent class="relative mr-4" :href="route('notifications.index')" wire:navigate>
        <x-icons.bell />
        <div
            class="border-1 absolute -end-1 top-1 inline-flex h-5 w-5 items-center justify-center rounded-full border-white bg-red-500 text-xs font-bold text-white dark:border-gray-300">
            {{ $this->notificationsCount }}
        </div>
    </x-buttons.transparent>
</div>
