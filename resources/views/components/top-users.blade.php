<x-list>
    <div class="border-b border-gray-200 p-3 last:border-b-0 dark:border-gray-700">
        <div class="flex items-center gap-3">
            <span class="font-bold text-gray-900 dark:text-white">
                {{ __('Most helpful') }}
            </span>

            <span class="text-xs font-thin text-gray-600 dark:text-gray-400">
                {{ __('Last 30 days') }}
            </span>
        </div>
    </div>

    @foreach ($users as $user)
        <x-list-item class="!p-3">
            <x-slot name="avatar">
                <x-user-avatar :user="$user" width="sm" />
            </x-slot>

            <x-slot name="value">
                <x-links.default class="!text-sm" href="{{ $user->profile_path }}" :value="$user->username" wire:navigate />
            </x-slot>

            <x-slot name="actions">
                <div class="flex items-center gap-3">
                    <x-icons.check-circle />

                    <span class="text-sm font-bold text-gray-900 dark:text-gray-400">
                        {{ $user->solutions_count }}
                    </span>
                </div>
            </x-slot>
        </x-list-item>
    @endforeach
</x-list>
