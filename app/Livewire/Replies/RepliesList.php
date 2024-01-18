<?php

namespace App\Livewire\Replies;

use App\Models\Reply;
use App\Models\Thread;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Usernotnull\Toast\Concerns\WireToast;
use Illuminate\Pagination\LengthAwarePaginator;

class RepliesList extends Component
{
    use WithPagination, WireToast;

    public Thread $thread;

    #[Validate('required|min:2|max:5000')]
    public string $body = '';

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

    #[On('reply-deleted')]
    public function updateReplies(): void
    {
    }

    public function create(Reply $reply)
    {
        $this->validate();

        Reply::create([
            'user_id' => Auth::id(),
            'thread_id' => $this->thread->id,
            'parent_id' => $reply->id,
            'body' => $this->body
        ]);

        $this->reset('body');
    }

    public function render(): View
    {
        return view('livewire.replies.replies-list');
    }
}
