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

        toast()->success('Thread deleted')->pushOnNextPage();

        $this->redirect(route('threads.index'), navigate: true);
    }

    public function pinThread(): void
    {
        $this->authorize('pin', $this->thread);

        $this->thread->pin();

        toast()->success('Thread pinned')->push();
    }

    public function unpinThread(): void
    {
        $this->authorize('pin', $this->thread);

        $this->thread->unpin();

        toast()->success('Thread unpinned')->push();
    }

    public function closeThread(): void
    {
        $this->authorize('close', $this->thread);

        $this->thread->close();

        toast()->success('Thread closed')->push();
    }

    public function openThread(): void
    {
        $this->authorize('close', $this->thread);

        $this->thread->open();

        toast()->success('Thread opened')->push();
    }

    public function render(): View
    {
        return view('livewire.threads.thread-show');
    }
}
