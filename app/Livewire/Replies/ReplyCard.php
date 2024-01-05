<?php

namespace App\Livewire\Replies;

use App\Models\Reply;
use App\Models\Thread;
use Livewire\Component;
use App\Livewire\Forms\ReplyForm;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class ReplyCard extends Component
{
    public Thread $thread;

    public Reply $reply;

    public ReplyForm $form;

    public bool $isAuthoredByUser;

    public bool $bestReplyExists;

    public bool $isBestReply;

    public bool $isEditing = false;

    public function mount(Thread $thread, Reply $reply): void
    {
        $this->thread = $thread;

        $this->reply = $reply;

        $this->form->setProperties($reply);

        $this->isAuthoredByUser = $reply->isAuthoredBy(Auth::user());

        $this->bestReplyExists = $thread->hasBestReply();

        $this->isBestReply = $thread->hasAsBestReply($reply);
    }

    public function update(): void
    {
        $this->authorize('update', $this->reply);

        $this->form->validate();

        $this->reply->update($this->form->all());

        $this->isEditing = false;
    }

    public function markAsBestReply(): void
    {
        $this->authorize('update', $this->thread);

        $this->thread->markAsBestReply($this->reply);

        $this->isBestReply = true;

        $this->redirect(route('threads.show', $this->thread->slug), navigate: true);
    }

    public function removeBestReply(): void
    {
        $this->authorize('update', $this->thread);

        $this->thread->removeBestReply();

        $this->isBestReply = false;

        $this->redirect(route('threads.show', $this->thread->slug), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.replies.reply-card');
    }
}
