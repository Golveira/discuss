<x-section>
    <div class="grid gap-8 lg:grid-cols-4">
        <div class="lg:col-span-3">
            <x-content-card class="relative mb-8">
                {{-- Actions --}}
                <x-slot name="actions">
                    @can('update', $thread)
                        <x-threads.actions :thread="$thread" />
                    @endcan
                </x-slot>

                <x-slot name="header">
                    {{-- Username --}}
                    <x-links.secondary class="flex items-center gap-3" href="#" wire:navigate>
                        <x-user-avatar :user="$thread->author" width="sm" />
                        {{ $thread->author->username }}
                    </x-links.secondary>

                    {{-- Date --}}
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        {{ $thread->date_for_humans }}
                    </p>
                </x-slot>

                <x-slot name="body">
                    {{-- Title --}}
                    <h1 class="mb-6 text-3xl font-bold text-gray-900 dark:text-white">
                        {{ $thread->title }}
                    </h1>

                    {{-- Body --}}
                    <p class="text-base leading-relaxed text-gray-900 dark:text-gray-300">
                        {!! nl2br($thread->body) !!}
                    </p>
                </x-slot>

                <x-slot name="footer">
                    @guest
                        {{-- Likes count --}}
                        <x-likes-count :count="$thread->likes_count" />
                    @else
                        {{-- Like button --}}
                        {{-- <livewire:like-button :model="$discussion" /> --}}
                    @endguest
                </x-slot>
            </x-content-card>

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
