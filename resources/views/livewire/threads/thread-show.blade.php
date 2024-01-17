<x-section class="space-y-6">
    {{-- Thread header --}}
    <x-threads.header :$thread />

    <div class="grid gap-8 lg:grid-cols-4">
        <div class="space-y-6 lg:col-span-3">
            {{-- Thread content --}}
            <x-threads.content :$thread />

            {{-- Replies list --}}
            <livewire:replies.replies-list :$thread />
        </div>

        <div class="space-y-4 pt-4 lg:col-span-1">
            {{-- Thread category --}}
            <div class="space-y-2 border-b border-gray-300 pb-4 dark:border-gray-700">
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    Category
                </div>

                <div class="flex items-center gap-2">
                    <span class="rounded-lg bg-gray-300 p-1 dark:bg-gray-700">
                        {{ $thread->channel->emoji }}
                    </span>

                    <a class="text-sm text-gray-600 hover:text-blue-700 dark:text-gray-100 dark:hover:text-blue-500"
                        href="{{ route('channels', $thread->channel->slug) }}" wire:navigate>
                        {{ $thread->channel->name }}
                    </a>
                </div>
            </div>

            {{-- Thread participants --}}
            <div class="space-y-2 border-b border-gray-300 pb-4 dark:border-gray-700">
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    {{ $thread->participants()->count() }} Participants
                </div>

                <div class="flex flex-wrap items-center gap-2">
                    @foreach ($thread->participants() as $participant)
                        <x-tooltip value="{{ $participant->username }}">
                            <a href="{{ route('profile.show', $participant->username) }}" wire:navigate>
                                <x-avatar :image="$participant->avatar_path" width="xs" />
                            </a>
                        </x-tooltip>
                    @endforeach
                </div>
            </div>

            {{-- Subscribe button --}}
            @auth
                <x-threads.subscribe :$thread />
            @endauth
        </div>
    </div>
</x-section>
