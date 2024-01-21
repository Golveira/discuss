<?php

namespace App\Livewire;

use App\Models\Reply;
use App\Models\Thread;
use Livewire\Component;
use App\Livewire\Forms\ReplyForm;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class ReplyItem extends Component
{
    public Thread $thread;

    public Reply $reply;

    public ReplyForm $replyForm;

    public ReplyForm $editForm;

    public string $type = 'parent';

    public bool $isEditing = false;

    public bool $isReplying = false;

    public bool $isAnswer;

    public bool $isAuthoredByUser;

    public function mount(Thread $thread, Reply $reply): void
    {
        $this->thread = $thread;

        $this->reply = $reply;

        $this->editForm->setProperties($reply);

        $this->isAnswer = $thread->hasAsBestReply($reply);

        $this->isAuthoredByUser = $reply->isAuthoredByUser();
    }

    public function editReply(): void
    {
        $this->authorize('update', $this->reply);

        $this->editForm->validate();

        $this->reply->update(['body' => $this->editForm->body]);

        $this->isEditing = false;
    }

    public function deleteReply(): void
    {
        $this->authorize('delete', $this->reply);

        $this->reply->delete();

        $this->dispatch('reply-deleted');
    }

    public function postReply(): void
    {
        if (Auth::guest() || $this->thread->isClosed()) {
            abort(403);
        }

        $this->replyForm->validate();

        $this->thread->addReply(
            $this->replyForm->body,
            $this->reply->id
        );

        $this->isReplying = false;

        $this->replyForm->reset();

        $this->dispatch('nested-reply-created');
    }

    public function markAsAnswer(): void
    {
        $this->authorize('markAsAnswer', $this->reply);

        if ($this->thread->hasBestReply()) {
            return;
        }

        $this->thread->markAsBestReply($this->reply);

        $this->isAnswer = true;

        $this->dispatch('best-reply-updated');
    }

    public function unmarkAsAnswer(): void
    {
        $this->authorize('markAsAnswer', $this->reply);

        $this->thread->removeBestReply();

        $this->isAnswer = false;

        $this->dispatch('best-reply-updated');
    }

    private function getViewName(): string
    {
        return $this->type === 'parent' ? 'parent' : 'nested';
    }

    public function render(): View
    {
        return view("livewire.{$this->getViewName()}-reply");
    }
}
