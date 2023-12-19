@props(['discussion'])

<x-dropdown align="right" width="32">
    <x-slot name="trigger">
        <button
            class="inline-flex items-center rounded-lg bg-white p-2 text-center text-sm font-medium text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-50 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-600"
            type="button">
            <x-icons.dots-horizontal />
        </button>
    </x-slot>

    <x-slot name="content">
        <x-dropdown-button :href="route('discussions.edit', $discussion->slug)" wire:navigate>
            {{ __('Edit') }}
        </x-dropdown-button>

        <livewire:discussion.delete :discussion="$discussion" />
    </x-slot>
</x-dropdown>
