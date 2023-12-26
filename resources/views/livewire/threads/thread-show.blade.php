<x-section>
    <div class="grid gap-8 lg:grid-cols-4">
        <div class="lg:col-span-3">
            {{-- Thread Content --}}
            <x-threads.card :thread="$thread" />

            {{-- Replies List --}}
            <livewire:replies.replies-list :thread="$thread" />
        </div>

        <div class="space-y-8 lg:col-span-1">
            {{-- User --}}
            <x-card>
                <div class="flex flex-col items-center gap-3">
                    <x-links.secondary class="flex flex-col items-center gap-3" href="#" wire:navigate>
                        <x-user-avatar :user="$thread->author" width="lg" />
                        <span class="text-lg">{{ $thread->author->username }}</span>
                    </x-links.secondary>

                    <span class="text-gray-400">
                        {{ __('Joined') }} {{ $thread->author->joined_date }}
                    </span>
                </div>
            </x-card>

            {{-- Subscribe --}}
            <x-card class="space-y-4">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                    {{ __('Notifications') }}
                </h2>

                <x-buttons.primary class="w-full">
                    {{ __('Subscribe') }}
                </x-buttons.primary>

                <p class="text-sm text-gray-400">
                    {{ __("You're not receiving notifications from this thread.") }}
                </p>
            </x-card>
        </div>
    </div>
</x-section>
