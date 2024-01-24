<?php

namespace App\Livewire;

use App\Events\ReplyWasCreated;
use App\Livewire\Forms\ReplyForm;
use App\Models\Thread;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class RepliesList extends Component
{
    use WireToast, WithPagination;

    public Thread $thread;

    public ReplyForm $replyForm;

    #[On('reply-deleted')]
    #[On('nested-reply-created')]
    public function updateReplies(): void
    {
    }

    #[Computed]
    public function replies(): LengthAwarePaginator
    {
        return $this->thread
            ->replies()
            ->parentReply()
            ->with(['author', 'likes'])
            ->with(['children.author', 'children.likes'])
            ->oldest()
            ->paginate();
    }

    public function create(): void
    {
        if (Auth::guest() || $this->thread->isClosed()) {
            abort(403);
        }

        $this->replyForm->validate();

        $reply = $this->thread->replies()->create([
            'body' => $this->replyForm->body,
            'user_id' => Auth::id(),
        ]);

        $reply->toggleLike(Auth::user());

        event(new ReplyWasCreated($reply));

        $this->replyForm->reset();
    }

    public function render(): View
    {
        return view('livewire.replies-list', [
            'commentsCount' => $this->replies->total(),
            'repliesCount' => $this->thread->replies()->childReply()->count(),
        ]);
    }
}
