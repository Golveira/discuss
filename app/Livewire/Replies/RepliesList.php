<?php

namespace App\Livewire\Replies;

use App\Models\Reply;
use App\Models\Thread;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class RepliesList extends Component
{
    use WithPagination;

    public Thread $thread;

    #[Validate('required|min:5|max:5000')]
    public string $body;

    #[Computed]
    public function replies(): LengthAwarePaginator
    {
        return $this->thread
            ->replies()
            ->oldest()
            ->paginate();
    }

    public function create()
    {
        $this->validate();

        Reply::create([
            'user_id' => Auth::id(),
            'thread_id' => $this->thread->id,
            'body' => $this->body,
        ]);

        toast()->success('Reply created!')->push();

        $this->reset('body');

        $this->gotoPage($this->replies()->lastPage());
    }

    public function render(): View
    {
        return view('livewire.replies.replies-list');
    }
}
