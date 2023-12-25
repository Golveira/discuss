<?php

namespace App\Livewire\Replies;

use App\Models\Thread;
use Livewire\Component;
use Livewire\WithPagination;
use App\Livewire\Forms\ReplyForm;
use Livewire\Attributes\Computed;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class RepliesList extends Component
{
    use WithPagination;

    public Thread $thread;

    public ReplyForm $form;

    #[Computed]
    public function replies(): LengthAwarePaginator
    {
        return $this->thread
            ->replies()
            ->oldest()
            ->paginate();
    }

    public function create(): void
    {
        $this->form->validate();

        $this->thread->replies()->create([
            'user_id' => Auth::id(),
            'body' => $this->form->body,
        ]);

        toast()->success('Reply created!')->push();

        $this->form->reset();

        $this->gotoPage($this->replies()->lastPage());
    }

    public function render(): View
    {
        return view('livewire.replies.replies-list');
    }
}
