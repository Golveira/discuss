<x-list>
    <div class="border-b border-gray-200 p-4 last:border-b-0 dark:border-gray-700">
        <div class="flex items-center gap-3">
            <span class="text-lg font-bold text-gray-900 dark:text-white">
                {{ __('Most helpful') }}
            </span>

            <span class="text-xs font-thin text-gray-600 dark:text-gray-400">
                {{ __('Last 30 days') }}
            </span>
        </div>
    </div>

    @foreach ($users as $user)
        <x-list-item>
            <x-slot name="avatar">
                <x-avatar :image="$user->avatar_path" width="sm" :placeholder="$user->username_initials" />
            </x-slot>

            <x-slot name="value">
                <x-links.secondary href="#" :value="$user->username" />
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
