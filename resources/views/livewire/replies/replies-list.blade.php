<div class="space-y-8 pb-6">
    @foreach ($this->replies as $reply)
        <livewire:replies.thread-reply :$thread :$reply wire:key="{{ $reply->id }}" />
    @endforeach

    {{ $this->replies->links() }}

    <x-replies.create-reply :$thread />
</div>
