<?php

namespace App\Livewire\Replies;

use App\Models\Reply;
use App\Models\Thread;
use Livewire\Component;
use Livewire\WithPagination;
use App\Livewire\Forms\ReplyForm;
use Livewire\Attributes\Computed;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Usernotnull\Toast\Concerns\WireToast;
use Illuminate\Pagination\LengthAwarePaginator;

class RepliesList extends Component
{
    use WithPagination, WireToast;

    public ReplyForm $form;

    public Thread $thread;

    #[Computed]
    public function replies(): LengthAwarePaginator
    {
        return $this->thread->replies()->oldest()->paginate();
    }

    public function create(): void
    {
        $this->form->validate();

        Reply::create([
            'user_id' => Auth::id(),
            'thread_id' => $this->thread->id,
            'body' => $this->form->body,
        ]);

        toast()->success('Reply created!')->push();

        $this->form->reset();
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
