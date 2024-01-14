<?php

namespace App\Livewire\Replies;

use App\Models\Thread;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Illuminate\Contracts\View\View;
use Usernotnull\Toast\Concerns\WireToast;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\On;

class RepliesList extends Component
{
    use WithPagination, WireToast;

    public Thread $thread;

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

    #[On('reply-created')]
    #[On('reply-deleted')]
    public function updateReplies(): void
    {
    }

    public function render(): View
    {
        return view('livewire.replies.replies-list');
    }
}
