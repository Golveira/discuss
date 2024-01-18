<?php

namespace App\Livewire\Replies;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\Attributes\Validate;

class NestedReply extends Component
{
    public Thread $thread;

    public Reply $reply;

    public bool $isEditing = false;

    #[Validate('required|min:2|max:5000')]
    public string $body;

    public function mount(Reply $reply): void
    {
        $this->reply = $reply;

        $this->body = $reply->body;
    }

    public function update(): void
    {
        $this->authorize('update', $this->reply);

        $this->validate();

        $this->reply->update(['body' => $this->body]);

        $this->isEditing = false;
    }

    public function delete(): void
    {
        $this->authorize('delete', $this->reply);

        $this->reply->delete();

        $this->dispatch("child-reply-deleted.{$this->reply->parent_id}");
    }

    public function render(): View
    {
        return view('livewire.replies.nested-reply');
    }
}
