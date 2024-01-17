<?php

namespace App\Livewire\Replies;

use App\Models\Reply;
use App\Models\Thread;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Usernotnull\Toast\Concerns\WireToast;

class ReplyCard extends Component
{
    use WireToast;

    public Reply $reply;

    public Thread $thread;

    public bool $isAuthoredByUser;

    public bool $isBestReply;

    public bool $isEditing = false;

    public bool $isReplying = false;

    #[Validate('required|min:2|max:5000')]
    public string $editReplyBody = '';

    #[Validate('required|min:2|max:5000')]
    public string $nestedReplyBody = '';

    public function mount(Thread $thread, Reply $reply): void
    {
        $this->thread = $thread;

        $this->reply = $reply;

        $this->editReplyBody = $reply->body;

        $this->isAuthoredByUser = $reply->isAuthoredBy(Auth::user());

        $this->isBestReply = $thread->hasAsBestReply($reply);
    }

    public function reply()
    {
        $this->validate();

        Reply::create([
            'user_id' => Auth::id(),
            'thread_id' => $this->thread->id,
            'parent_id' => $this->reply->id,
            'body' => $this->body,
        ]);

        toast()->success('Reply created!')->push();
    }

    public function update(): void
    {
        $this->authorize('update', $this->reply);

        $this->validate();

        $this->reply->update(['body' => $this->editReplyBody]);

        toast()->success('Reply updated!')->push();

        $this->isEditing = false;
    }

    public function delete(): void
    {
        $this->authorize('delete', $this->reply);

        $this->reply->delete();

        toast()->success('Reply deleted!')->push();

        $this->dispatch('child-reply-deleted.' . $this->reply->parent_id);
    }

    public function markAsBestReply(): void
    {
        $this->authorize('update', $this->thread);

        $this->thread->markAsBestReply($this->reply);

        $this->reloadPage();
    }

    public function removeBestReply(): void
    {
        $this->authorize('update', $this->thread);

        $this->thread->removeBestReply();

        $this->reloadPage();
    }

    protected function reloadPage(): void
    {
        $this->redirect(route('threads.show', $this->thread), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.replies.reply-card');
    }
}
