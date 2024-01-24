<?php

namespace App\Livewire\Pages\Threads;

use App\Models\Thread;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Usernotnull\Toast\Concerns\WireToast;

class ThreadShow extends Component
{
    use WireToast;

    public Thread $thread;

    #[On('best-reply-updated')]
    public function updateThread(): void
    {
    }

    #[Computed]
    public function threadParticipants(): Collection
    {
        return $this->thread->participants();
    }

    public function delete(): void
    {
        $this->authorize('delete', $this->thread);

        $this->thread->delete();

        toast()->success('Thread deleted')->pushOnNextPage();

        $this->redirect(route('threads.index'), navigate: true);
    }

    public function subscribe(): void
    {
        $this->thread->subscribe(Auth::user());
    }

    public function unsubscribe(): void
    {
        $this->thread->unsubscribe(Auth::user());
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
        return view('livewire.pages.threads.thread-show')
            ->title($this->thread->title);
    }
}
