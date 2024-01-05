<div class="space-y-8">
    @guest
        <x-card class="text-center">
            <x-links.secondary href="{{ route('login') }}" wire:navigate>
                {{ __('Sign in to participate') }}
            </x-links.secondary>
        </x-card>
    @else
        {{-- Create Reply Form --}}
        <x-replies.create />
    @endauth

    {{-- Replies --}}
    @foreach ($this->replies as $reply)
        <livewire:replies.reply-card :$thread :$reply wire:key="{{ $reply->id }}" />
    @endforeach {{ $this->replies->links() }}
</div>
