<div class="space-y-8 pb-6">
    {{-- Replies --}}
    @foreach ($this->replies as $reply)
        <livewire:replies.thread-reply :$thread :$reply wire:key="{{ $reply->id }}" />
    @endforeach

    {{-- Pagination --}}
    {{ $this->replies->links() }}

    {{-- Create reply  --}}
    <x-replies.create-reply :$thread />
</div>
