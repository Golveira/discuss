<div
    class="space-y-3 rounded-b-lg border-b border-transparent bg-green-200 p-3 px-4 py-3 dark:bg-green-900 dark:bg-opacity-40">
    <div class="flex items-center gap-1 text-sm text-green-700 dark:text-green-500">
        <x-icons.check-circle class="mr-1 h-6 w-6" />

        <span>Answered by</span>

        <a class="font-bold hover:underline" href="{{ route('profile.show', $thread->bestReply->author->username) }}">
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
