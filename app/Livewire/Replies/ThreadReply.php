<?php

namespace App\Livewire\Replies;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Validate;

class ThreadReply extends Component
{
    public Thread $thread;

    public Reply $reply;

    public bool $isEditing = false;

    public bool $isReplying = false;

    #[Validate('required|min:2|max:5000')]
    public string $body = '';

    #[Validate('required|min:2|max:5000')]
    public string $childBody = '';

    #[On('child-reply-deleted.{reply.id}')]
    public function refreshReply(): void
    {
    }

    public function mount(Thread $thread, Reply $reply): void
    {
        $this->thread = $thread;

        $this->reply = $reply;

        $this->body = $reply->body;
    }

    public function createChild(): void
    {
        $this->validateOnly('childBody');

        Reply::create([
            'user_id' => Auth::id(),
            'thread_id' => $this->thread->id,
            'parent_id' => $this->reply->id,
            'body' => $this->childBody
        ]);

        $this->isReplying = false;

        $this->reset('childBody');
    }

    public function update(): void
    {
        $this->authorize('update', $this->reply);

        $this->validateOnly('body');

        $this->reply->update(['body' => $this->body]);

        $this->isEditing = false;
    }

    public function delete(): void
    {
        $this->authorize('delete', $this->reply);

        $this->reply->delete();

        $this->dispatch('reply-deleted');
    }

    public function render(): View
    {
        return view('livewire.replies.thread-reply');
    }
}
