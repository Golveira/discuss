@props(['selectedTab', 'threads', 'replies'])

<div class="space-y-8">
    <div class="border-b border-gray-200 dark:border-gray-700">
        <ul class="-mb-px flex flex-wrap text-center text-sm font-medium text-gray-500 dark:text-gray-400">
            <li class="me-2">
                <button @class([
                    'group inline-flex items-center justify-center gap-1 rounded-t-lg p-4 hover:text-gray-600 dark:hover:text-gray-300',
                    'border-b-2 border-gray-700 dark:border-gray-100 text-gray-700 dark:text-gray-100' =>
                        $selectedTab == 'threads',
                ]) wire:click="$set('selectedTab', 'threads')">
                    {{ __('Threads') }}
                </button>
            </li>

            <li class="me-2">
                <button @class([
                    'group inline-flex items-center justify-center gap-1 rounded-t-lg p-4 hover:text-gray-600 dark:hover:text-gray-300',
                    'border-b-2 border-gray-700 dark:border-gray-100 text-gray-700 dark:text-gray-100' =>
                        $selectedTab == 'replies',
                ]) wire:click="$set('selectedTab', 'replies')">
                    {{ __('Replies') }}
                </button>
            </li>
        </ul>
    </div>

    <div class="space-y-8">
        @if ($selectedTab === 'threads')
            @forelse ($this->threads as $thread)
                <x-profile.thread-card :$thread />
            @empty
                <x-alert type="primary" message="No threads yet." />
            @endforelse

            {{ $this->threads->links() }}
        @endif

        @if ($selectedTab === 'replies')
            @forelse ($this->replies as $reply)
                <x-profile.reply-card :$reply />
            @empty
                <x-alert type="primary" message="No replies yet." />
            @endforelse

            {{ $this->replies->links() }}
        @endif
    </div>
</div>
