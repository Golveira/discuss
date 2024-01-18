<div class="space-y-3">
    {{-- Title --}}
    <h1 class="text-3xl text-gray-900 dark:text-white">
        <span>{{ $thread->title }}</span>

        <span class="text-gray-600 dark:text-gray-400">
            #{{ $thread->id }}
        </span>
    </h1>

    <div class="flex flex-wrap gap-3 text-sm text-gray-600 dark:text-gray-400">
        {{-- Answered by --}}
        @if ($thread->hasBestReply())
            <div class="flex items-center gap-1 rounded-full border border-gray-300 px-3 py-2 dark:border-gray-700">
                <span class="text-green-700 dark:text-green-500">
                    <x-icons.check-circle class="mr-1 h-4 w-4" />
                </span>

                <span>Answered by</span>

                <x-links.secondary href="{{ route('profile.show', $thread->bestReply->author->username) }}">
                    {{ $thread->bestReply->author->username }}
                </x-links.secondary>
            </div>
        @else
            <div class="flex items-center gap-1 rounded-full border border-gray-300 px-3 py-2 dark:border-gray-700">
                <span>Unanswered</span>
            </div>
        @endif

        {{-- Category name --}}
        <div class="flex items-center gap-1">
            <x-links.secondary href="{{ route('profile.show', $thread->author->username) }}">
                {{ $thread->author->username }}
            </x-links.secondary>

            <span>asked this question in</span>

            <x-links.secondary href="{{ route('channels', $thread->channel->slug) }}">
                {{ $thread->channel->name }}
            </x-links.secondary>
        </div>
    </div>
</div>
