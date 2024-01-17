@props(['thread'])

<x-content-card>
    <x-slot name="actions">
        {{-- Thread actions --}}
        @can('update', $thread)
            <x-threads.actions :$thread />
        @endcan
    </x-slot>

    <x-slot name="header">
        <div class="flex items-center gap-2">
            {{-- Thread author --}}
            <x-links.secondary class="flex items-center gap-3"
                href="{{ route('profile.show', $thread->author->username) }}" wire:navigate>
                <x-avatar :image="$thread->author->avatar_path" width="sm" />
                <span>{{ $thread->author->username }}</span>
            </x-links.secondary>

            {{-- Thread date --}}
            <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ $thread->date_for_humans }}
            </p>
        </div>
    </x-slot>

    <x-slot name="body">
        <div class="space-y-3">
            {{-- Thread body --}}
            <x-html-content>
                {{ $thread->body }}
            </x-html-content>

            {{-- Like button --}}
            <livewire:like-button :likeable="$thread" wire:key="thread-like-{{ $thread->id }}" />
        </div>
    </x-slot>

    <x-slot name="footer">
        {{-- Best answer preview --}}
        @if ($thread->hasBestReply())
            <div
                class="space-y-3 rounded-b-lg border-b border-transparent bg-green-200 p-3 px-4 py-3 dark:bg-green-900 dark:bg-opacity-40">
                <div class="flex items-center gap-1 text-sm text-green-700 dark:text-green-500">
                    <x-icons.check-circle class="mr-1 h-6 w-6" />

                    <span>Answered by</span>

                    <a class="font-bold hover:underline"
                        href="{{ route('profile.show', $thread->bestReply->author->username) }}">
                        {{ $thread->bestReply->author->username }}
                    </a>
                </div>

                <x-html-content>
                    {{ $thread->bestReply->body_excerpt }}
                </x-html-content>

                <div>
                    <a class="flex items-center gap-1 font-bold text-green-700 first:text-sm hover:underline dark:text-blue-500"
                        href="#comment-{{ $thread->bestReply->id }}">
                        View full answer
                        <x-icons.arrow-down />
                    </a>
                </div>
            </div>
        @endif
    </x-slot>
</x-content-card>
