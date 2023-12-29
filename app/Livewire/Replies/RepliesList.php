<?php

namespace App\Livewire\Replies;

use App\Models\Reply;
use App\Models\Thread;
use Livewire\Component;
use Livewire\WithPagination;
use App\Events\ReplyWasCreated;
use App\Livewire\Forms\ReplyForm;
use Livewire\Attributes\Computed;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Usernotnull\Toast\Concerns\WireToast;
use Illuminate\Pagination\LengthAwarePaginator;

class RepliesList extends Component
{
    use WithPagination, WireToast;

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

        $reply = Reply::create([
            'user_id' => Auth::id(),
            'thread_id' => $this->thread->id,
            'body' => $this->form->body,
        ]);

        event(new ReplyWasCreated($reply));

        toast()->success('Reply created!')->push();

        $this->form->reset();

        $this->gotoPage($this->replies()->lastPage());
    }

    public function delete(Reply $reply): void
    {
        $this->authorize('delete', $reply);

        $reply->delete();

        toast()->success('Reply deleted!')->push();

        $this->resetPage();
    }

    public function render(): View
    {
        return view('livewire.replies.replies-list');
    }
}
