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

    public function mount(Thread $thread): void
    {
        $this->thread = $thread;
    }

    public function delete()
    {
        $this->authorize('delete', $this->thread);

        $this->thread->delete();

        toast()->success('Thread Deleted!')->pushOnNextPage();

        return $this->redirect(route('threads.index'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.threads.thread-show');
    }
}
