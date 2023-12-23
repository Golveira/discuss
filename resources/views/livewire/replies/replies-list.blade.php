<div class="space-y-8">
    <div class="flex items-center justify-between">
        {{-- Replies Count --}}
        <h2 class="text-lg font-bold text-gray-900 dark:text-white">
            {{ __('Replies') }} ({{ $this->thread->replies_count }})
        </h2>
    </div>

    @auth
        {{-- Create comment --}}
        {{-- <livewire:comment.create :discussion="$discussion" /> --}}
    @else
        {{-- <x-card class="text-center">
            <a class="font-bold text-gray-900 hover:underline dark:text-gray-300" href="{{ route('login') }}">
                {{ __('Login to comment') }}
            </a>
        </x-card> --}}
    @endauth

    {{-- Replies --}}
    @foreach ($this->replies as $reply)
        <livewire:replies.reply-card :$reply :key="$reply->id" />
    @endforeach

    {{-- Pagination --}}
    {{ $this->replies->links() }}
</div>
