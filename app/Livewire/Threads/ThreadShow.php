<?php

namespace App\Livewire\Threads;

use App\Models\Thread;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Usernotnull\Toast\Concerns\WireToast;

class ThreadShow extends Component
{
    use WireToast;

    public Thread $thread;

    public function subscribe(): void
    {
        $this->thread->subscribe(Auth::user());
    }

    public function unsubscribe(): void
    {
        $this->thread->unsubscribe(Auth::user());
    }

    public function delete(): void
    {
        $this->authorize('delete', $this->thread);

        $this->thread->delete();

        toast()->success('Thread Deleted!')->pushOnNextPage();

        $this->redirect(route('threads.index'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.threads.thread-show');
    }
}
