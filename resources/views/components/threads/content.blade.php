@props(['thread'])

<div @class([
    'rounded-lg border border-gray-300 bg-white dark:border-gray-700 dark:bg-gray-900',
    '!border-blue-500 dark:!border-blue-800' => $thread->isAuthoredByUser(),
])>
    <div class="mx-4 my-3 flex items-center justify-between">
        <div class="flex items-center gap-2">
            {{-- Author avatar --}}
            <x-users.user-avatar :user="$thread->author" />

            {{-- Date --}}
            <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ $thread->date_for_humans }}
            </p>

            {{-- Author badge --}}
            <x-users.author-badge value="Author" />
        </div>

        {{-- Actions --}}
        @can('update', $thread)
            <x-threads.actions-dropdown :$thread />
        @endcan
    </div>

    <div class="mx-4 my-3">
        <div class="space-y-3">
            {{-- Body --}}
            <x-html-content>
                {{ $thread->body }}
            </x-html-content>

            {{-- Like button --}}
            <livewire:like-button :likeable="$thread" wire:key="thread-like-{{ $thread->id }}" />
        </div>
    </div>

    <div>
        {{-- Best answer preview --}}
        @if ($thread->hasBestReply())
            <x-threads.best-reply-preview :$thread />
        @endif
    </div>
</div>
