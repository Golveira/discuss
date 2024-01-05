<?php

namespace App\Livewire\Threads;

use App\Models\Thread;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Usernotnull\Toast\Concerns\WireToast;

class ThreadShow extends Component
{
    use WireToast;

    public Thread $thread;

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
