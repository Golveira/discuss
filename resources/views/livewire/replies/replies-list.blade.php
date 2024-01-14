<div class="space-y-8 pb-6">
    @auth
        {{-- Trigger --}}
        <x-replies.create-reply-button />

        {{-- Create Reply --}}
        <livewire:reply-composer :$thread />
    @else
        <p class="text-center text-gray-700 dark:text-gray-300">
            <x-links.primary href="{{ route('login') }}" value="Sign in" wire:navigate />
            <span>to participate in this conversation.</span>
        </p>
    @endauth

    {{-- Replies --}}
    @foreach ($this->replies as $reply)
        <livewire:replies.reply-card :$thread :$reply wire:key="{{ $reply->id }}" />
    @endforeach

    {{-- Pagination --}}
    {{ $this->replies->links() }}
</div>
