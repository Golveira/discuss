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

        $this->reloadPage();
    }

    public function unpinThread(): void
    {
        $this->authorize('pin', $this->thread);

        $this->thread->unpin();

        toast()->success('Thread unpinned')->push();

        $this->reloadPage();
    }

    public function closeThread(): void
    {
        $this->authorize('close', $this->thread);

        $this->thread->close();

        toast()->success('Thread closed')->push();

        $this->reloadPage();
    }

    public function openThread(): void
    {
        $this->authorize('close', $this->thread);

        $this->thread->open();

        toast()->success('Thread opened')->push();

        $this->reloadPage();
    }

    // don't know about this
    private function reloadPage(): void
    {
        $this->redirect(route('threads.show', $this->thread), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.threads.thread-show');
    }
}
