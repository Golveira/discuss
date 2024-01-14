<?php

namespace App\Livewire\Replies;

use App\Models\Reply;
use App\Models\Thread;
use Livewire\Component;
use App\Livewire\Forms\ReplyForm;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Usernotnull\Toast\Concerns\WireToast;

class ReplyCard extends Component
{
    use WireToast;

    public ReplyForm $form;

    public Reply $reply;

    public Thread $thread;

    public bool $isAuthoredByUser;

    public bool $isBestReply;

    public bool $isEditing = false;

    #[On('child-reply-created.{reply.id}')]
    #[On('child-reply-deleted.{reply.id}')]
    public function updateReply(): void
    {
    }

    public function mount(Thread $thread, Reply $reply): void
    {
        $this->thread = $thread;

        $this->reply = $reply;

        $this->form->setProperties($reply);

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

        $this->form->validate();

        $this->reply->update($this->form->all());

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
