<?php

namespace App\Livewire;

use App\Events\ReplyWasCreated;
use App\Livewire\Forms\ReplyForm;
use App\Models\Thread;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Usernotnull\Toast\Concerns\WireToast;
use Illuminate\Pagination\LengthAwarePaginator;

class RepliesList extends Component
{
    use WithPagination, WireToast;

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
            ->parent()
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

        $reply = $this->thread->addReply($this->replyForm->body);

        $reply->toggleLike(Auth::user());

        event(new ReplyWasCreated($reply));

        $this->replyForm->reset();
    }

    public function render(): View
    {
        return view('livewire.replies-list', [
            'commentsCount' =>  $this->replies->total(),
            'repliesCount' => $this->thread->replies()->child()->count(),
        ]);
    }
}
