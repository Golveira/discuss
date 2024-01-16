<div class="rounded-lg border border-gray-200 bg-white shadow dark:border-gray-800 dark:bg-gray-900">
    <div class="border-b border-gray-200 p-3 last:border-b-0 dark:border-gray-800">
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
        <div class="flex gap-3 border-b border-gray-200 p-2 last:border-b-0 dark:border-gray-800">
            <x-avatar :image="$user->avatar_path" width="xs" />

            <div class="flex flex-1 justify-between gap-4  lg:items-center">
                <div class="font-medium dark:text-white">
                    <x-links.default class="!text-sm" href="{{ $user->profile_path }}" :value="$user->username" wire:navigate />
                </div>

                <div class="flex gap-3">
                    <div class="flex items-center gap-4">
                        <x-icons.check-circle />

                        <span class="text-sm font-bold text-gray-900 dark:text-gray-400">
                            {{ $user->solutions_count }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
