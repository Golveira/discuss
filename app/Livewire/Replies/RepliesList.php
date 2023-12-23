<?php

namespace App\Livewire\Replies;

use App\Models\Thread;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class RepliesList extends Component
{
    use WithPagination;

    public Thread $thread;

    public function mount(Thread $thread): void
    {
        $this->thread = $thread;
    }

    #[Computed]
    public function replies(): LengthAwarePaginator
    {
        return $this->thread
            ->replies()
            ->oldest()
            ->paginate();
    }

    public function render(): View
    {
        return view('livewire.replies.replies-list');
    }
}
