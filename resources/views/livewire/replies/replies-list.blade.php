<div class="space-y-8 pb-6">
    {{-- Replies --}}
    @foreach ($this->replies as $reply)
        <livewire:replies.reply-card :$thread :$reply wire:key="{{ $reply->id }}" />
    @endforeach

    {{-- Pagination --}}
    {{ $this->replies->links() }}

    @auth
        {{-- Create Reply --}}
        <x-replies.create-form />
    @else
        <p class="text-center text-gray-700 dark:text-gray-300">
            <x-links.primary href="{{ route('login') }}" value="Sign in" wire:navigate />
            <span>to participate in this conversation.</span>
        </p>
    @endauth
</div>
